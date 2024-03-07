@extends('layout.master')
@section('title','To Do List')
@section('content')
    <div class="welcome">
        <div class="container">
            <div class="row py-5">
                <div class="col-lg-8 mx-auto ">
                    <div class="card shadow">
                        <div class="card-body">
                                <h3 class='text-center'>To Do List</h3>
                                <hr>
                                <div class='text-center'>
                                    <a href="{{route('auth#loginPage')}}">
                                        <button class='btn btn-info text-white col-6 fs-4 my-5 text-center py-3 shadow'>Create Tasks</button>
                                    </a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection