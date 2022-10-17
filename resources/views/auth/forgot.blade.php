@extends('layout')
@section('title', 'Forgot Password')

@section('content')
    <form class="forgot" action="{{ route('post_forgot') }}" method="post">
        @csrf
        <h1 class="h3 mb-3 fw-normal">Forgot password</h1>

        @if($errors->any())
            <x-alert type="danger" header="Reset password failed!" :errors="$errors" />
        @endif

        <div class="form-floating">
            <input type="email" class="form-control" id="floatingEmail" name="email" value="{{ old('email') }}">
            <label for="floatingEmail">Email address</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" name="password">
            <label for="floatingPassword">Password</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPasswordConfirmation" name="password_confirmation">
            <label for="floatingPasswordConfirmation">Password Confirmation</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Reset</button>
        <a class="w-100 btn btn-link mt-2" href="{{ route('login') }}">Sign in</a>
        <p class="mt-5 mb-3 text-muted">&copy; {{ date('Y') }}</p>
    </form>
@endsection
