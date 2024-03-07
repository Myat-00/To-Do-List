<?php

namespace App\Http\Controllers;

use App\Models\ToDoList;
use App\Models\CompleteTask;
use Illuminate\Http\Request;
use App\Models\UncompleteTask;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ToDoListController extends Controller
{
    //direct home page
    public function home()
    {
        $tasks = UncompleteTask::where("user_id",Auth::user()->id)
                            ->where('status',0)
                            ->latest()
                            ->paginate(4);
        $comTasks = CompleteTask::where('user_id',Auth::user()->id)
                                  ->get();
        //                     ->paginate(3);
        $tasks->appends(request()->all());
        return view('home',compact('tasks','comTasks'));
    }

    public function create()
    {
        $this->checkValidation();
        $data = [
            'user_id'=>Auth::user()->id,
            'task_name'=>request()->task,
            'date'=>request()->date,
            'clock'=>request()->clock,
        ];
        ToDoList::create($data);
        UncompleteTask::create($data);
        return back()->with(['createSuccess'=>"Task Created!"]);
    }

    //direct edit page
    public function edit($id)
    {
        $list = ToDoList::where("id",$id)->first();
        return view('edit',compact('list'));
    }

    public function update($id)
    {
        $this->checkValidation();
        
        $data = [
            'task_name'=>request()->task,
            'date'=>request()->date,
            'clock'=>request()->clock,
        ];
        ToDoList::where("id",$id)->update($data);
        UncompleteTask::where("id",$id)->update($data);
        return redirect()->route('main#home')->with(['updateSuccess'=>'Successfully Updated!']);
    }

    //destroy
    public function destroy($id)
    {
        ToDoList::where("id",$id)->delete();
        UncompleteTask::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Successfully Deleted!']);
    }

    //check validation
    public function checkValidation()
    {
        request()->validate([
            'task'=>'required',
            'date'=>'required',
            'clock'=>'required'
        ],[
            'task.required'=>"*Please fill Task's Name...",
            'date.required'=>"*Please choose Date...'",
            'clock.required'=>"*Please choose Time...",
        ]);
    }

    //ajax complete task
    public function complete(Request $request)
    {
        CompleteTask::create([
            'user_id'=>$request->userId,
            'task_id'=>$request->taskId,
            'status'=>$request->status
        ]);
        ToDoList::where('id',$request->taskId)->update([
            'status'=>$request->status
        ]);
        UncompleteTask::where('id',$request->taskId)->delete();
        $response = [
            'status'=> true
        ];
        return response()->json($response, 200);
    }

    //ajax delete all
    public function deleteAll(Request $request)
    {
        CompleteTask::where('user_id',$request->userId)->delete();
        ToDoList::where('user_id',$request->userId)
                  ->where('status',$request->status)
                  ->delete();
        $response = [
            'status' => true
        ];
        return response()->json($response, 200);
    }
}
