@props(['tasks','comTasks'])
@extends('layout.master')
@section('title','To Do List')
@section('content')
<div class="home">
    <div class='container'>
        <div class="row py-4 px-3">
            <div class="col-lg-5 mb-5">
                <div class='mb-3'>
                    <span class='btn btn-info text-white'><i class="fa-regular fa-circle-user me-2"></i>{{Auth::user()->name}}</span>
                </div>
                @if(session('createSuccess'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><i class="fa-regular fa-circle-check me-2"></i>{{session('createSuccess')}}</strong> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if(session('updateSuccess'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong><i class="fa-regular fa-pen-to-square me-2"></i>{{session('updateSuccess')}}</strong> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if(session('deleteSuccess'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><i class="fa-regular fa-triangle-exclamation me-2"></i>{{session('deleteSuccess')}}</strong> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="card shadow">
                    <div class="card-header">
                        <h3 class='text-center'>To Do List</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route('create#todolist')}}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="taskname" class="form-label">Task</label>
                                <input type="text" id='taskname' name="task" placeholder="Name..." class='form-control @error('task')
                                    is-invalid
                                @enderror' value="{{old('task')}}">
                                @error('task')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="taskdate" class="form-label">Date</label>
                                <input type="date" id='taskdate' name="date" class='form-control @error('date')
                                    is-invalid
                                @enderror' value="{{old('date')}}">
                                @error('date')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="taskTime" class="form-label">Time</label>
                                <input type="time" id='taskTime' name="clock" class='form-control @error('clock')
                                    is-invalid
                                @enderror'>
                                @error('clock')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group float-end">
                                <button type='submit' class='btn bg-info px-4 text-white shadow-sm'>Create</button>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
            <div class="col-lg-7">
                <div class='d-flex justify-content-between'>
                    <h4 class='d-flex justify-content-center align-items-center'>Total - {{$tasks->total()}}</h4>
                    <div class='mb-3 d-flex justify-content-end'>
                        <a href="{{route('toDoList#completeTaskPage')}}" class='text-decoration-none me-3'>
                            <button type="button" class="btn btn-info text-white position-relative shadow-sm">
                                Complete Task
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{$comTasks->count()}}
                                <span class="visually-hidden">unread messages</span>
                                </span>
                            </button>
                        </a> 

                        <form action="{{route('logout')}}" method="POST">
                            @csrf
                            <button type='submit' class='btn btn-info text-white shadow-sm'>Logout</button>
                        </form>
                    </div>
                </div>
                @if($tasks->count())
                <div class='table-responsive'>
                <table class='table table-hover mytable table-white shadow-sm'>
                    <thead class='mb-3'>
                        <tr>
                            <th>Task</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class='table-group-divider'>
                        @foreach ($tasks as $task)
                            <tr>
                                <td class='col-4'>
                                    <input type="hidden" id="userId" value='{{Auth::user()->id}}'>
                                    <input type="hidden" id="taskId" value="{{$task->id}}">
                                    {{ucfirst($task->task_name)}}
                                </td>
                                <td class='col-2'>{{ \Carbon\Carbon::parse($task->date)->format('d/m/Y')}}</td>
                                <td class='col-2'>{{ date('h:i A', strtotime($task->clock)) }}</td>
                                <td class='col-2'>
                                    
                                    <select class='form-check border-0' id='change'>
                                        <option value="0">Pending</option>
                                        <option value="1">Complete</option>
                                    </select>
                                </td>
                                <td class='col-2'>
                                    <a href="{{route('toDoList#edit',$task->id)}}" class='text-decoration-none me-2'>
                                        <i class="fa-solid fa-pen-to-square fs-5 text-primary" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-custom-class="custom-tooltip"
                                        data-bs-title="Edit" id='edit'></i>
                                    </a>
                                    <a href="{{route('toDoList#destroy',$task->id)}}" class='text-decoration-none'>
                                        <i class="fa-solid fa-trash-can fs-5 text-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-custom-class="custom-tooltip"
                                        data-bs-title="Delete"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                @else
                <h3 class="text-center text-muted my-5">There is No Task.</h3>
                @endif
                <div class=''>
                    {{$tasks->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('jContent')
<script>
    let btns = document.querySelectorAll('#change');
    btns.forEach(function(btn){
        btn.addEventListener('change',function(){
            let status = this.value;
            let parentTr = this.closest('tr');
            let task = parentTr.querySelector('#taskId');
            let user = parentTr.querySelector('#userId');
            let taskId = task.value;
            let userId = user.value;
            let data = {
                'taskId' : taskId,
                'userId' : userId,
                'status' : status
            };
            // console.log(data);
            $.ajax({
                    type : 'get',
                    url : "/ajax/todolist/complete/task",
                    data : data,
                    dataType : 'json',
                    success : function(response)
                    {
                        if(response.status)
                        {
                            location.reload();
                        }
                    }
                })
        })
    })
</script>

    {{-- <script>
        $(document).ready(function(){
            $('.change').change(function(){
                $parentNodes = $(this).parents('tr');
                $data = {
                    'userId' : $parentNodes.find('#userId').val(),
                    'taskId' : $parentNodes.find('#taskId').val(),
                    'currentStatus' : $(this).val()
                };
                $.ajax({
                    type : 'get',
                    url : "/ajax/todolist/complete/task",
                    data : $data,
                    dataType : 'json',
                    success : function(response)
                    {
                        if(response.status)
                        {
                            location.reload();
                        }
                    }
                })
            })
        })
    </script> --}}
@endsection