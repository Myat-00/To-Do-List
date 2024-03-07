<?php

namespace App\Http\Controllers;

use App\Models\CompleteTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompleteTaskController extends Controller
{
    //direct complet task page
    public function completePage()
    {
        $comTasks = CompleteTask::select('complete_tasks.*','to_do_lists.task_name as name','to_do_lists.date as date','to_do_lists.clock as time')
                                  ->leftJoin('to_do_lists','complete_tasks.task_id','to_do_lists.id')
                                  ->where('complete_tasks.user_id',Auth::user()->id)
                                  ->where('complete_tasks.status',1)
                                  ->latest()
                                  ->paginate(8);
        $comTasks->appends(request()->all());
        return view('complete_task',compact('comTasks'));
    }
}
