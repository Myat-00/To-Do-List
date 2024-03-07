@extends('layout.master')
@section('title','Register')
@section('content')
<div class="register">
    <div class="container">
        <div class="row py-5">
            <div class="col-lg-6 mx-auto">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class='text-center mb-3'>Register Form</h3>
                        <hr>
                        <form action="{{route('register')}}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="username" class="form-label">Name</label>
                                <input type="text" id='username' name="name" placeholder="Name..." class='form-control @error('name')
                                    is-invalid
                                @enderror' value="{{old('name')}}">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
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
                                <label for="pass" class="form-label">Password</label>
                                <input type="password" id='pass' name="password" placeholder="Password..." class='form-control @error('password')
                                    is-invalid
                                @enderror'>
                                @error('password')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="confirm" class="form-label">Password Confirmation</label>
                                <input type="password" id='confirm' name="password_confirmation" placeholder="Password..." class='form-control @error('password_confirmation')
                                    is-invalid
                                @enderror'>
                                @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group d-flex justify-content-between ">
                                <a href="{{route('auth#loginPage')}}" class='text-decoration-none'>Already have an account?</a>
                                <button type='submit' class='btn btn-info text-white px-4 shadow-sm'>Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
