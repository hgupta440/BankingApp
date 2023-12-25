@extends('layouts.user')

@section('content')
    <div class="card">
        <div class="card-header">Welcome {{ Ucfirst(auth()->user()->name) }}</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-muted">
                    YOUR ID
                </div>
                <div class="col-md-4">
                    {{ auth()->user()->email }}
                </div>
            </div>                                 
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-md-4 text-muted">
                    YOUR BALANCE
                </div>
                <div class="col-md-4">
                   {{ number_format(auth()->user()->amount,2) }} INR
                </div>
            </div>
        </div>
    </div>
@endsection