@extends('layouts.user')

@section('content')
    <div class="card">
        <div class="card-header">Statement of account</div>
        <div class="card-body p-0">
            <div class="row">   
                 <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                              <th>#</th>
                              <th>DATE TIME</th>
                              <th class="text-end">AMOUNT</th>
                              <th>TYPE</th>
                              <th>DETAIL</th>
                              <th class="text-end">BALANCE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($transactions->count() > 0)
                                @foreach($transactions as $index => $transaction)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td >{{ $transaction->created_at->format('d-m-Y h:i a') }}</td>
                                        <td class="text-end">{{ number_format($transaction->amount,2) }}</td>
                                        <td>{{ Ucfirst($transaction->type) }}</td>
                                        <td>{{ $transaction->detail }}</td>
                                        <td class="text-end">{{ number_format($transaction->balance,2) }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="6">No Transaction</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>                                 
        </div>
        <div class="card-footer d-flex align-items-center">

            <ul class="pagination ">
                @if($transactions->lastPage() > 1)
                    @if($transactions->previousPageUrl())
                        <li class="page-item">
                            <a class="page-link" href="{{ $transactions->previousPageUrl() }}">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M15 6l-6 6l6 6"></path></svg>
                            </a>
                        </li>
                    @endif
                    @for($i=1; $i<=$transactions->lastPage(); $i++)
                        <li class="page-item @if($i == $transactions->currentPage()) active @endif">
                            <a class="page-link" href="{{ $transactions->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    @if($transactions->nextPageUrl())
                        <li class="page-item">
                            <a class="page-link" href="{{ $transactions->nextPageUrl() }}">
                              <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 6l6 6l-6 6"></path></svg>
                            </a>
                          </li>
                    @endif
                @endif
            </ul>
        </div>
    </div>
@endsection