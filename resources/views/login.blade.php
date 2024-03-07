@extends('layout.master')
@section('title','Login')
@section('content')
    <div class="login">
        <div class="container">
            <div class="row py-5">
                <div class="col-lg-6 mx-auto">
                    <div class="card shadow">
                        <div class="card-body">
                            <h3 class='text-center mb-3'>Login Form</h3>
                            <hr>
                            <form action="{{route('login')}}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="useremail" class="form-label">Email</label>
                                    <input type="email" id='useremail' name="email" placeholder="Email Address..." class='form-control @error('email')
                                        is-invalid
                                    @enderror' value="{{old('email')}}">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="userpass" class="form-label">Password</label>
                                    <input type="password" id='userpass' name="password" placeholder="Password..." class='form-control @error('password')
                                        is-invalid
                                    @enderror'>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group d-flex justify-content-between ">
                                    <a href="{{route('auth#registerPage')}}" class='text-decoration-none'>Very First Time?</a>
                                    <button type='submit' class='btn btn-info text-white px-4 shadow-sm'>Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection