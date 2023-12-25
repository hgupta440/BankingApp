@extends('layouts.user')

@section('content')
    <div class="card">
        <div class="card-header">Withdraw Money</div>
        <div class="card-body">
            <div class="row">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>      
                @endif     
                <form action="{{ route('withdrawMoney') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <input type="float" class="form-control" placeholder="Enter amount to withdraw" name="amount" autocomplete="off" value="{{ old('amount') }}">
                        @if ($errors->has('amount'))
                            <span class="text-danger">{{ $errors->first('amount') }}</span>
                        @endif
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">Withdraw</button>
                    </div>
                </form>
            </div>                                 
        </div>
    </div>
@endsection