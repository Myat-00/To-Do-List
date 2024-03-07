@props(['comTasks'])
@extends('layout.master')
@section('title','Complete Tasks')
@section('content')
    <div class="suTask">
        <div class="container">
            <div class="row py-4 px-3">
                <div class="col-lg-7 mx-auto">
                    <div class='d-flex justify-content-between'>
                        <a href="{{route('main#home')}}" class='text-decoration-none text-dark d-flex justify-content-center align-items-center'><h5>Back</h5></a>
                        <h4 class='d-flex justify-content-center align-items-center'>Total - {{$comTasks->total()}}</h4>
                        <div class='mb-3 d-flex justify-content-end'>
                            {{-- <h4 class='me-2'>Total - {{$comTasks->count()}}</h4> --}}
                            <button class='btn btn-danger me-3 delete shadow-sm'>Delete All</button>
                            <div class=''>
                                <span class='btn btn-info text-white'><i class="fa-regular fa-circle-user me-2"></i>{{Auth::user()->name}}</span>
                            </div>
                        </div>
                    </div>
                    @if($comTasks->count())
                    <div class=' table-responsive'>
                    <table class='table shadow-sm'>
                        <thead>
                            <tr>
                                <th>Task</th>
                                <th>Date</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <input type="hidden" id="userId" value="{{$comTasks[0]->user_id}}">
                            <input type="hidden" id="status" value="{{$comTasks[0]->status}}">
                            @foreach ($comTasks as $comTask)
                                <tr>
                                    
                                    <td>{{ucfirst($comTask->name)}}</td>
                                    <td>{{ \Carbon\Carbon::parse($comTask->date)->format('d/m/Y')}}</td>
                                    <td>{{ date('h:i A', strtotime($comTask->time)) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        {{$comTasks->links()}}
                    </div>
                    </div>
                    @else
                    <h3 class='text-center text-muted my-5'>There is No Complete Task!</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('jContent')
<script>
    $(document).ready(function(){
        $('.delete').click(function(){
            $data = {
                'userId' : $('#userId').val(),
                'status' : $('#status').val()
            };
            $.ajax({
                type : 'get',
                url : "/ajax/todolist/delete/all/task",
                data : $data,
                dataType : 'json',
                success : function(response)
                {
                    if(response.status)
                    {
                        window.location.href="/toDoList/home";
                    }
                }
            })
        })
    })
</script>
@endsection