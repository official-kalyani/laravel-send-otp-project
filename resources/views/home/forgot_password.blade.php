@extends('layouts.master')
@section('content')

    <div class="contactus">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="title">
                        <h2>Forget Password</h2>

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
                    <h1 style="color: green">Forget Password!</h1>
                    <h4><b>Enter Your Email Here to Get New Password !</b></h4>

                    <form id="forgotPasswordForm" name="forgotPasswordForm" action="{{ url('/forgot/password') }}"
                        method="post">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="email">Email</label>
                                <input class="form-control" placeholder="Enter Email" type="text" name="email" id="email" required>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <button type="submit" class="send">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <h1 style="color: red">Log In Here</h1>
                    <form class="main_form" id="loginForm" name="loginForm" action="{{ url('/login') }}"
                        method="post">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="email">Email</label>
                                <input class="form-control" placeholder="Email" type="text" name="email" id="email">
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="password">Password</label>
                                <input class="form-control" placeholder="Enter Password" type="password" name="password"
                                    id="password">
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <button type="submit" class="send">Log In</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
