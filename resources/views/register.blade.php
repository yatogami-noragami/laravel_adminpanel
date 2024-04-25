@extends('layouts.master')
@section('title', 'register page')
@section('content')
    <div class="container">
        <div class="row">
            <div class=" offset-lg-4 col-lg-4 border mt-3 p-3 shadow-lg">
                <h3 class=" text-center">
                    <i class="fa-solid fa-truck"></i>
                </h3>
                <h5 class=" text-center">Welcome back!</h5>
                <form action="{{ route('register') }}" method="post" class="">
                    @csrf

                    <div class="form-floating my-3  fw-bold">
                        <input type="text" class="form-control text-danger fw-bold" id="name" name="name"
                            placeholder="name@example.com">
                        <label for="name">Name</label>
                    </div>
                    @error('name')
                        <small class=" text-danger">{{ $message }}</small>
                    @enderror


                    <div class="form-floating my-3  fw-bold">
                        <input type="email" class="form-control text-danger fw-bold" id="email" name="email"
                            placeholder="name@example.com">
                        <label for="email">Email address</label>
                    </div>
                    @error('email')
                        <small class=" text-danger">{{ $message }}</small>
                    @enderror


                    <div class="form-floating my-3  fw-bold position-relative">
                        <input type="password" class="form-control text-danger fw-bold" id="password" name="password"
                            placeholder="password">
                        <label for="password">Password</label>
                        <button class="btn" id="eye">
                            <i class="fa-solid fa-eye-slash fa-5"></i>
                        </button>
                    </div>
                    @error('password')
                        <small class=" text-danger">{{ $message }}</small>
                    @enderror

                    <div class="form-floating my-3  fw-bold">
                        <input type="password" class="form-control text-danger fw-bold" id="password_confirmation"
                            name="password_confirmation" placeholder="password">
                        <label for="password_confirmation">Confirm Password</label>
                    </div>
                    @error('password_confirmation')
                        <small class=" text-danger">{{ $message }}</small>
                    @enderror

                    <a href="{{ route('auth#loginPage') }}" class=" text-decoration-none d-block">login</a>

                    <button type="submit" class="btn btn-primary my-3 w-100" id="signup">register</button>

                </form>
            </div>
        </div>
    </div>
@endsection
