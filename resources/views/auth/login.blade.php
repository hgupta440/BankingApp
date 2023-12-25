@extends('layouts.auth')

@section('content')
<form class="card card-md" action="{{ route('authenticate') }}" method="post">
    <div class="card-body">
        <h2 class="h2 text-center mb-4">Login to your account</h2>
        @csrf
        <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email" class="form-control" placeholder="Enter Email" name="email" autocomplete="off" value="{{ old('email') }}">
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <div class="mb-2">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" placeholder="Password" name="password" autocomplete="off">
            @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
        </div>
        <div class="mb-2">
            <label class="form-check">
                <input type="checkbox" name="remember" class="form-check-input">
                <span class="form-check-label">Remember me</span>
            </label>
        </div>
        <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">Sign in</button>
        </div>
    </div>
</form>
<div class="text-center text-muted mt-3">
  Don't have account yet? <a href="{{ route('register') }}" tabindex="-1">Sign up</a>
</div>
@endsection