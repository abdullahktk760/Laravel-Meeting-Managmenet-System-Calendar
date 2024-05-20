@extends('layouts/fullLayoutMaster')

@section('title', 'Login Page')

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
@endsection

@section('content')
    <div class="auth-wrapper auth-basic px-2">
        <div class="auth-inner my-2">
            <!-- Login basic -->
            <div class="card mb-0">
                <div class="card-body">
                        <h2 class="brand-text text-primary ms-1 mb-3">User Registration 👋</h2>
                            <p class="card-text mb-2"></p>
                        <form class="auth-login-form mt-2" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-1">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" required autofocus autocomplete="name"
                                    class="form-control" id="name" placeholder="Enter your Name"
                                    aria-describedby="name" tabindex="1" autofocus />
                            </div>
                            <div class="mb-1">
                                <label for="login-email" class="form-label">Email</label>
                                <input type="email" name="email" required autofocus autocomplete="username"
                                    class="form-control" id="login" placeholder="Enter your email"
                                    aria-describedby="login-email" tabindex="1" autofocus />
                            </div>
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="login-password_confirm">Password</label>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input id="password" type="password" name="password_confirmation" required autofocus autocomplete="password"
                                    class="form-control form-control-merge" tabindex="2"
                                    placeholder="Enter your password"
                                    aria-describedby="login-password_confirm"/>
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                            <div class="mt-1 mb-2">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="login-password">Password</label>
                                </div>
                                <div class="input-group input-group-merge form-password-toggle">
                                    <input id="password" type="password" name="password" required autofocus autocomplete="password"
                                        class="form-control form-control-merge" tabindex="2"
                                        placeholder="Enter your password"
                                        aria-describedby="login-password"/>
                                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger" id="flash-message" role="alert">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <button class="btn btn-primary w-100" tabindex="4">Register</button>
                        </form>
                        <p class="text-center mt-2">
                            <span>If you have</span>
                            <a href="{{ route('login') }}">
                                <span>Already Account</span>
                            </a>
                        </p>
                </div>
            </div>
            <!-- /Login basic -->
        </div>
    </div>
@endsection

@section('vendor-script')
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
@endsection

@section('page-script')
<script>
    $(document).ready(function () {
        setTimeout(function () {
        var errorMessage = document.getElementById('flash-message');
        if (errorMessage) {
            errorMessage.style.display = 'none';
        }
    }, 5000);

    });
</script>
    <script src="{{ asset(mix('js/scripts/pages/auth-login.js')) }}"></script>
@endsection
