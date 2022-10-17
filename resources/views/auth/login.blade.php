@extends('layout')
@section('title', 'Login')

@section('content')
    <form class="sign-in" action="{{ route('post_login') }}" method="post">
        @csrf
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

        @if($errors->any())
            <x-alert type="danger" header="Login failed!" :errors="$errors" />
        @endif

        @if(session()->has('error'))
            <x-alert type="danger" header="Login failed!" message="{{ session('error') }}" />
        @endif

        @if(session()->has('success'))
            <x-alert type="success" header="Reset password success!" message="{{ session('success') }}" />
        @endif

        <div class="form-floating">
            <input type="email" class="form-control" id="floatingEmail" name="email" value="{{ old('email') }}">
            <label for="floatingEmail">Email address</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" name="password">
            <label for="floatingPassword">Password</label>
        </div>
        <div class="mb-2 g-recaptcha" data-sitekey="6LeM_YciAAAAAKvMbX3vaK8PsUU8kEZ9IQeDIiSs"></div>
        <div class="mb-3 text-end">
            <a href="{{ route('forgot') }}">Reset Password</a>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        <a class="w-100 btn btn-link mt-2" href="{{ route('register') }}">Sign up</a>
        <p class="mt-5 mb-3 text-muted">&copy; {{ date('Y') }}</p>
    </form>
@endsection
