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
use App\Models\TaskComment;
use App\Models\Label;

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


        TaskMember::select('TaskID' ,'UserID')->where("TaskID","=", $task_id )->whereNotIn('UserID', $request->Members)->delete();
        $task_member = array();

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

        TaskLabel::select('TaskID' ,'LabelID')->where("TaskID","=", $task_id )->whereNotIn('LabelID', $request->Lables)->delete();
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
    public function Change_task_description(Request $request)
    {
        $userid = $request->user_id;
        $task_id = $request->TaskID;

        $task_description =Tasks::where("id","=", $task_id )->update(['Dsc' => $request->description]);

        $result = export::data("ChangeTaskDescription", $$request->description);
        return response()->json($result, 200);
    }

    public function select_task_due_date(Request $request)
    {
        $userid = $request->user_id;
        $task_id = $request->TaskID;

        $task_DueDate = Tasks::select('TaskID' ,'DueDate')->where("TaskID","=", $task_id )->update(['DueDate' => $request->DueDate]);

        $result = export::data("SelectTaskDueDate", $task_DueDate);
        return response()->json($result, 200);
    }

    public function change_task_check_list(Request $request)
    {
        $userid = $request->user_id;
        $task_id = $request->TaskID;

        $task_CheckLists = Tasks::select('TaskID' ,'CheckLists')->where("TaskID","=", $task_id )->update(['CheckLists' => $request->CheckLists]);

        $result = export::data("ChangeTaskCheckList", $task_CheckLists);
        return response()->json($result, 200);
    }

    public function add_task_attachment(Request $request)
    {
        $userid = $request->user_id;
        $task_id = $request->TaskID;

        //TODO: peyman

        $result = export::data("AddTaskAttachment", "TODO: peyman");
        return response()->json($result, 200);
    }

    public function send_task_comment(Request $request)
    {
        $userid = $request->user_id;
        $task_id = $request->TaskID;

        $comment = array(
            "TaskID" => $task_id,
            "UserID" => $userid,
            "Text" => $request->text,
        );

        $task = TaskComment::create($comment);

        $result = export::data("SendTaskComment", $task);
        return response()->json($result, 200);
    }

    public function task_list(Request $request)
    {
        $userid = $request->user_id;

        $tasks = Tasks::select("tasks.id","tasks.name","tasks.Stat","tasks.DueDate","tasks.created_at","tasks.updated_at")->join('task_member', 'tasks.id', '=', 'task_member.TaskID')->where('task_member.UserID', '=', $userid)->get();

        $result = export::data("TaskList", $tasks);
        return response()->json($result, 200);
    }

    public function task_profile(Request $request)
    {
        $userid = $request->user_id;
        $task_id = $request->TaskID;

        $tasks = Tasks::select("tasks.*")->where('tasks.id', '=', $task_id)->get();

        $result = export::data("TaskProfile", $tasks);
        return response()->json($result, 200);
    }

    public function task_members(Request $request)
    {
        $userid = $request->user_id;
        $task_id = $request->TaskID;

        $tasks = TaskMember::select("task_member.*", "users.name", "users.email", "users.UserName")->join('users', 'users.id', '=', 'task_member.UserID')->where('task_member.TaskID', '=', $task_id)->get();

        $result = export::data("TaskMembers", $tasks);
        return response()->json($result, 200);
    }

    public function task_label(Request $request)
    {
        $userid = $request->user_id;
        $task_id = $request->TaskID;

        $tasks = Label::select("label.*")->join('task_label', 'label.id', '=', 'task_label.LabelID')->where('task_label.TaskID', '=', $task_id)->get();

        $result = export::data("TaskLabel", $tasks);
        return response()->json($result, 200);
    }

    public function create_label(Request $request)
    {
        $userid = $request->user_id;

        $task_data  = array(
            "name" => $request->Name,
            "color" => $request->Color,
        );

        $task = Label::create($task_data);

        $result = export::data("CreateLabel", $task);
        return response()->json($result, 200);
    }
    public function label_list(Request $request)
    {
        $userid = $request->user_id;


        $task = Label::get();

        $result = export::data("CreateLabel", $task);
        return response()->json($result, 200);
    }



}
