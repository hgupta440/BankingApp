@extends('layouts.user')

@section('content')
    <div class="card">
        <div class="card-header">Deposite Money</div>
        <div class="card-body">
            <div class="row">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>      
                @endif     
                <form action="{{ route('depositMoney') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <input type="float" class="form-control" placeholder="Enter amount to deposit" name="amount" autocomplete="off" value="{{ old('amount') }}">
                        @if ($errors->has('amount'))
                            <span class="text-danger">{{ $errors->first('amount') }}</span>
                        @endif
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">Deposit</button>
                    </div>
                </form>
            </div>                                 
        </div>
    </div>
@endsection