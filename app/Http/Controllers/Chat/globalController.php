<?php

namespace App\Http\Controllers\Chat;

use App\Events\PostCreatedEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use App\Models\Users;
use App\Models\ChatP2P;
use App\models\ChatGroup;
use App\Models\ChatGroupUsers;
use App\Models\ChatGroup_conversion;


use App\Http\controllers\export;
use App\Http\controllers\message_type;
use App\Http\controllers\redirect_address;

use Illuminate\Support\Facades\Mail;
use App\Mail\MailSender;
use Hamcrest\Type\IsNumeric;

class globalController extends Controller
{
    public function chat_history(Request $request)
    {
        $userid = $request->user_id;
        $chatHistory = ChatP2P::select('id', 'From', 'TO', 'Title', 'Content', 'ChatType', 'File', 'IsDelete', 'SeenDate', 'created_at')->where([
            ['From', '=', $userid],
            ['TO', '=', $request->id],
            ['IsDelete', '=', '0']
        ])->orwhere([
            ['TO', '=', $userid],
            ['From', '=', $request->id],
            ['IsDelete', '=', '0']
        ])->get();
        $result = export::data("ChatHistory", $chatHistory);
        return response()->json($result, 200);
    }
    public function chat_list(Request $request)
    {
        //TODO: peyman
        $userid = $request->user_id;
        $ChatList = Users::select(DB::raw('users.id, users.email, users.name, users.Avatar, max(chat_p2_p_s.created_at) as date'))->join('chat_p2_p_s', function ($join) {
            $join->on('users.id', '=', 'chat_p2_p_s.From')->orOn('users.id', '=', 'chat_p2_p_s.TO');
        })->where([
            ['chat_p2_p_s.TO', '=', $userid],
            ['chat_p2_p_s.IsDelete', '=', '0'],
            ['users.id', '!=', $userid],
        ])->orwhere([
            ['chat_p2_p_s.From', '=', $userid],
            ['chat_p2_p_s.IsDelete', '=', '0'],
            ['users.id', '!=', $userid],
        ])->groupBy('users.id')->get();
        $result = export::data("ChatList", $ChatList);
        return response()->json($result, 200);
    }

    public function group_list(Request $request)
    {
        $userid = $request->user_id;
        $group = ChatGroup::select('id', 'Name', 'Owner')->where([
            ['Owner', '=', $userid],
            ['IsDelete', '=', '0'],
        ])->get();
        $result = export::data("ChatList", $group);
        return response()->json($result, 200);
    }

    public function create_group(Request $request)
    {
        $userid = $request->user_id;

        $group_data  = array(
            "Name" => $request->Name,
            "Owner" => $userid,
        );

        $group = ChatGroup::create($group_data);
        $group_id  = $group->id;
        $UserGroup_data = array();

        for ($index = 0; $index < count($request->Users); $index++) {
            $UserGroup_data[$index] =  [
                'ChatGroupID' =>  $group_id,
                'UserID' => $request->Users[$index],
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ];
        }

        $UserGroup_data[count($request->Users)] =  [
            'ChatGroupID' =>  $group_id,
            'UserID' => $userid,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ];

        $UserGroup = ChatGroupUsers::insert($UserGroup_data);
        $result = export::data("CreateGroup", ["group" => $group, "UserGroup" => $UserGroup]);
        return response()->json($result, 200);
    }

    public function group_history(Request $request)
    {
        $chatHistory = ChatGroup_conversion::select('id', 'From', 'TO', 'Title', 'Content', 'ChatType', 'File', 'IsDelete', 'SeenDate', 'created_at')->where([
            ['TO', '=', $request->id],
            ['IsDelete', '=', '0']
        ])->get();
        $result = export::data("ChatHistory", $chatHistory);
        return response()->json($result, 200);
    }

    public function send_message(Request $request)
    {
        $userid = $request->user_id;

        $message_data = [
            "From" => $userid,
            "TO" => $request->id,
            "Title" => $request->title,
            "Content" => $request->message,
            "ChatType" => 1,
        ];
        $message =  ChatP2P::create($message_data);
        // $event = new PostCreatedEvent(["name"=>"peyman"]);
        // event($event);
        // dd();
        $user = Users::select("token")->where('id','=','1')->first(); 

        broadcast(new PostCreatedEvent(["data" => $message , "token" => $user->token]));

        $result = export::data("ChatHistory", $message);
        return response()->json($result, 200);
    }

    public function send_message_group(Request $request)
    {
        $userid = $request->user_id;

        $message_data = [
            "From" => $userid,
            "TO" => $request->id,
            "Title" => $request->title,
            "Content" => $request->message,
            "ChatType" => 1,
        ];

        $message =  ChatGroup_conversion::create($message_data);

        $result = export::data("ChatHistory", $message);
        return response()->json($result, 200);
    }

    public function delete_message(Request $request)
    {
        $userid = $request->user_id;

        $ChatP2P = ChatP2P::find($request->id);
        if (is_null($ChatP2P)) {
            $result = export::message(message_type::$error, "Error", "Not found data");
            return response()->json($result, 200);
        }
        $ChatP2P->update(["IsDelete" => 1]);
        $result = export::message(message_type::$message, "Message", "data is delete");
        return response()->json($result, 200);
    }

    public function delete_message_group(Request $request)
    {
        $userid = $request->user_id;

        $ChatGroup_conversion = ChatGroup_conversion::find($request->id);
        if (is_null($ChatGroup_conversion)) {
            $result = export::message(message_type::$error, "Error", "Not found data");
            return response()->json($result, 200);
        }
        $ChatGroup_conversion->update(["IsDelete" => 1]);
        $result = export::message(message_type::$message, "Message", "data is delete");
        return response()->json($result, 200);
    }

    public function send_file_chat(Request $request)
    {
        // TODO: peyman
        $userid = $request->user_id;
        $FileName = "filename.png";
        $path = $request->file('file')->move(public_path("/"), $FileName);
        $photoURL = url('/' . $FileName);

        return response()->json($photoURL, 200);
    }
}
