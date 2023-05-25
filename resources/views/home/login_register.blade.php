@extends('layouts.master')
@section('content')

    <div class="contactus">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="title">
                        <h2>Login-Register</h2>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (Session::has('error_message'))
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="text-center" style="color: #dc3545">{{ Session::get('error_message') }}</h4>
        </div>
        <?php Session::forget('error_message'); ?>
    @endif
    @if (Session::has('success_message'))
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="text-center" style="color: #0a9634">{{ Session::get('success_message') }}</h4>
        </div>
        <?php Session::forget('success_message'); ?>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- map -->
    <div class="contact">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <h1 style="color: green">Register Here!</h1>

                    <form class="main_form" id="registerValidate" name="registerValidate"
                        action="{{ url('/register') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="name">Name</label>
                                <input class="form-control" placeholder="Enter Name" type="text" name="name" id="name">
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="email">Email</label>
                                <input class="form-control" placeholder="Enter Email" type="text" name="email" id="email">
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="mobile">Mobile</label>
                                <input class="form-control" placeholder="Enter Mobile Number" type="text" name="mobile"
                                    id="mobile">
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="password">Password</label>
                                <input class="form-control" placeholder="Enter Password" type="password" name="password"
                                    id="password">
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <button type="submit" class="send">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <h1 style="color: red">Log In Here</h1>
                    <form class="main_form" id="loginForm" name="loginForm" action="{{ url('/login') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="email">Email</label>
                                <input class="form-control" placeholder="Email" type="text" name="email" id="email">
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="password">Password</label>
                                <input class="form-control" placeholder="Enter Password" type="password" name="password" id="password">
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <button type="submit" class="send">Log In</button>
                                <br>
                                <a href="{{ url('/forgot/password') }}">Forgot Password ?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
