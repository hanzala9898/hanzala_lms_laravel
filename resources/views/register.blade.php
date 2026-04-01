@extends('master2')
@section('register')

<div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/icon/logo.png" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="{{route('register')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="au-input au-input--full" type="text" name="name" placeholder="Hanzala9898">
                                </div>
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="Hanzala9898@example.com">
                                </div>
                                <div class="form-group mb-3">
                                    <label >Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Minimum 6 characters">
                                </div>
                                
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Register</button>
                                
                            </form>

                            <div class="register-link">
                                <p>
                                    Already have account?
                                    <a href="{{ route('login') }}">Sign In</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @endsection