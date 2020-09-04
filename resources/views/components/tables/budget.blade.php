@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
				<div class="card-header">
			    	<h4 class="text-center">{{$budget->description}}<small style="font-size:15px;"><a href="{{ route('budget.edit', [$budget]) }}" style="margin-left:8px;">edit <i class="far fa-edit"></i></a></small></h4>
			    	<hr>
			    	<div><b>Current Date:</b> {{date('F d, Y')}}</div>
			    	<div><b>View:</b> {{count($occurances)}} Month Forecast</div>
			    	<div><b>Last Checking Account Balance:</b> ${{$account_balance/100}} ({{$account_balance_date->format('F d, Y')}})<small><a href="{{ route('budget.account-balance.create', [$budget]) }}" style="margin-left:8px;"><i class="fas fa-plus-circle"></i> add new balance</a></small></div>
				</div>
				<div class="card-body" style="padding-bottom:50px;">
					<p>
						<a href="{{ route('budget.transaction.create', [$budget]) }}" style="margin-right:8px;"><i class="fas fa-plus-circle"></i> Add New Transaction</a> | 
						<a href="{{ route('budget.transaction.index', [$budget]) }}" style="margin-left:8px;margin-right:8px;"><i class="fas fa-money-bill-wave"></i> View All Transactions</a> | 
						<a href="{{ route('budget.link.form', [$budget]) }}" style="margin-left:8px;"><i class="fas fa-link"></i> Share this Budget</a>
					</p>
					<hr>
					@if(count($occurances) > 0)
						@foreach ($occurances as $month => $dates)
							<h4 style="margin-bottom:20px;">{{$month}}</h4>
							<div style="margin-left:30px;">
								@php
									$net = 0
								@endphp

								@foreach($dates as $date => $transactions)
								<div class="row">
									<div class="col-2">{{$date}}</div>
									<div class="col-10">
										@foreach($transactions as $transaction)
											@php
												$net = $transaction['transaction_detail']['amount_in_cents'] + $net; 
											@endphp
											<div class="row">
												<div class="col-6"><span>{{$transaction['transaction_detail']['description']}}</span> <small><a href="{{ route('budget.transaction.edit', ['budget' => $budget, 'transaction' => $transaction['transaction_detail']['id']]) }}" style="margin-left:8px;">edit <i class="far fa-edit"></i></a></small></div>
												<div class="col-3"><span class="{{$transaction['transaction_detail']['amount_in_cents'] > 0 ? 'text-success' : 'text-danger'}}">{{$transaction['transaction_detail']['formatted_amount']}}</span></div>
												<div class="col-3">
													@if($transaction['running_total']/100 < 0)
														<span class="text-danger">${{number_format(($transaction['running_total']/100), 2, '.', ',')}}</span>
													@else
														<span>${{number_format(($transaction['running_total']/100), 2, '.', ',')}}</span>
													@endif
												</div>
											</div>
										@endforeach
									</div>
								</div>
								@endforeach
								<div class="row" style="margin-top:15px;">
									<div class="col-12">
										<span class="badge {{$net > 0 ? 'badge-success' : 'badge-danger'}}" style="padding:6px">Net for {{$month}}: ${{$net/100}}</span>
									</div>
								</div>
							</div>
							@if($loop->iteration != $loop->count)
								<hr>
							@endif
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