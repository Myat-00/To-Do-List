@props(['list'])
@extends('layout.master')
@section('title','Edit To Do List')
@section('content')
<div class="edit">
    <div class="container">
        <div class="row py-5">
            <div class="col-lg-7 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h3 class='text-center'>Edit To Do List</h3>
                        <hr>
                        <form action="{{route('toDoList#update',$list->id)}}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="" class="form-label">Task</label>
                                <input type="text" name="task" placeholder="Name..." class='form-control @error('task')
                                    is-invalid
                                @enderror' value="{{old('task',$list->task_name)}}">
                                @error('task')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="form-label">Date</label>
                                <input type="date" name="date" class='form-control @error('date')
                                    is-invalid
                                @enderror' value="{{old('date',$list->date)}}">
                                @error('date')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="form-label">Time</label>
                                <input type="time" name="clock" class='form-control @error('clock')
                                    is-invalid
                                @enderror' value="{{old('clock',$list->clock)}}">
                                @error('clock')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group float-end">
                                <button type='submit' class='btn btn-info text-white px-4 shadow-sm'>Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
