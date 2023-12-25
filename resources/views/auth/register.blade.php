@extends('layouts.auth')

@section('content')

    <form  class= "card card-md" action="{{ route('store') }}" method="post">
        @csrf
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Create new account</h2>
            <div class="mb-3">
              <label class="form-label">Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{ old('email') }}">
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
              @if ($errors->has('password'))
                  <span class="text-danger">{{ $errors->first('password') }}</span>
              @endif
            </div>
            <div class="mb-3">
              <label class="form-check">
                <input type="checkbox" name="terms" class="form-check-input">
                <span class="form-check-label">Agree the <a href="{{ route('terms') }}" tabindex="-1" target="_BLANK">terms and policy</a>.</span>
              </label>
              @if ($errors->has('terms'))
                    <span class="text-danger">{{ $errors->first('terms') }}</span>
                @endif
            </div>
            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100">Create new account</button>
            </div>                    
        </div>
    </form>
    <div class="text-center text-muted mt-3">
      Already have account? <a href="{{ route('login') }}" tabindex="-1">Sign in</a>
    </div>
    
@endsection