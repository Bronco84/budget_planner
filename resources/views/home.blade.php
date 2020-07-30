@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Budget Tools') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                      <div class="col-12 text-center">
                        <a class="nav-link" href="{{route('budget')}}"><i class="fas fa-list-alt"></i>&nbsp;&nbsp;&nbsp;Go to budget view</a>
                        <a class="nav-link" href="{{route('transaction.create')}}"><i class="fas fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;Add Transaction</a>
                        <a class="nav-link" href="{{route('transaction.index')}}"><i class="fas fa-money-bill-wave"></i>&nbsp;&nbsp;&nbsp;View All Transactions</a>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
