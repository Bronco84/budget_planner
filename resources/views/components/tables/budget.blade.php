@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
				<div class="card-header">
			    	<div><b>Current Date:</b> {{date('F d, Y')}}</div>
			    	<div><b>View:</b> {{count($occurances)}} Month Projection</div>
			    	<div><b>Last Checking Account Balance:</b> ${{$account_balance/100}} ({{$account_balance_date->format('F d, Y')}})</div>
				</div>
				<div class="card-body">
					<p><a href="{{ route('transaction.create') }}" style="margin-right:8px;"><i class="fas fa-plus-circle"></i> Add New Transaction</a> | <a href="{{ route('transaction.index') }}" style="margin-left:8px;"><i class="fas fas fa-money-bill-wave"></i> View All Transactions</a></p>
					<hr>
					@if(count($occurances) > 0)
						@foreach ($occurances as $month => $dates)
							<h4 style="margin-bottom:20px;">{{$month}}</h4>
							<div style="margin-left:30px;">
								@foreach($dates as $date => $transactions)
								<div class="row">
									<div class="col-2">{{$date}}</div>
									<div class="col-10">
										@foreach($transactions as $transaction)
											<div class="row">
												<div class="col-6"><span>{{$transaction['transaction_detail']['description']}}</span> <small><a href="{{ route('transaction.edit', ['transaction' => $transaction['transaction_detail']['id']]) }}" style="margin-left:8px;">edit <i class="far fa-edit"></i></a></small></div>
												<div class="col-3"><span class="{{$transaction['transaction_detail']['amount_in_cents'] > 0 ? 'text-success' : 'text-danger'}}">{{$transaction['transaction_detail']['formatted_amount']}}</span></div>
												<div class="col-3">${{$transaction['running_total']/100}}</div>
											</div>
										@endforeach
									</div>
								</div>
								@endforeach
							</div>
							<hr>
				   		@endforeach

				   	@else
					   	<div class="text-danger text-center">
					   		<p>No transactions found for this period!</p>
					   	</div>
				   	@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection