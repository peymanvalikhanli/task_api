<?php

namespace App\Http\Controllers\Task;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use App\Models\Users;
use App\Models\Tasks;
use App\Models\TaskMember;
use App\Models\TaskLabel;

use App\Http\controllers\export;
use App\Http\controllers\message_type;
use App\Http\controllers\redirect_address;

use Illuminate\Support\Facades\Mail;
use App\Mail\MailSender;
use App\Models\TaskMember as ModelsTaskMember;
use Exception;
use Hamcrest\Type\IsNumeric;


class globalController extends Controller
{
    public function create_task(Request $request)
    {
        $userid = $request->user_id;

        $task_data  = array(
            "name" => $request->Name,
            "CreatedBy" => $userid,
        );

        $task = Tasks::create($task_data);
        $result = export::data("CreatTask", $task);
        return response()->json($result, 200);
    }

    public function select_task_members(Request $request)
    {
        $userid = $request->user_id;

        $task_id = $request->TaskID;
        $task_member = array();

        //TaskMember::delete($task_id);

        $taskmember = TaskMember::select('TaskID' ,'UserID')->where("TaskID","=", $task_id )->whereNotIn('UserID', $request->Members)->delete();

        for ($index = 0; $index < count($request->Members); $index++) {
            $data =  [
                'TaskID' =>  $task_id,
                'UserID' => $request->Members[$index],
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ];
            try {
                $task_member[$index] = TaskMember::insert($data);
            } catch (Exception $e) {

                $task_member[$index] = false;
            }
        }

        $data =  [
            'TaskID' =>  $task_id,
            'UserID' => $userid,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ];

        try {
            $task_member[count($request->Members)] = TaskMember::insert($data);
        } catch (Exception $e) {

            $task_member[count($request->Members)] = false;
        }
        $result = export::data("SelectTaskMembers", $task_member);
        return response()->json($result, 200);
    }

    public function Select_task_lable(Request $request)
    {
        $userid = $request->user_id;

        $task_id = $request->TaskID;
       // TaskLabel::delete($task_id);
        $task_label = array();
        for ($index = 0; $index < count($request->Lables); $index++) {
            $data =  [
                'TaskID' =>  $task_id,
                'LabelID' => $request->Lables[$index],
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ];
            try {
                $task_label[$index] = TaskLabel::insert($data);
            } catch (Exception $e) {
                $task_label[$index] = false;
            }
        }

        $result = export::data("SelectTaskLable", $task_label);
        return response()->json($result, 200);
    }
}
