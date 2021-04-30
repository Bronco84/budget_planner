@extends('layouts.app')
<script>
	function deleteTransaction(id){
		if(confirm('Are you sure you want to delete this transaction?')){
			axios.delete('/budget/{{$budget->id}}/transaction/' + id)
			.then(function(){
				location.reload();
			})
		}
	}
</script>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
				<div class="card-header">
					<h4>Transactions</h4>
				</div>
				<div class="card-body">
					<p><a href="{{ route('budget.transaction.create', [$budget]) }}" style="margin-right:8px;"><i class="fas fa-plus-circle"></i> Add New Transaction</a> | <a href="{{ route('budget.show', [$budget]) }}" style="margin-left:8px;"><i class="fas fas fa-money-bill-wave"></i> View Budget</a></p>
					@if(count($transactions) > 0)
					    <table class="table table-striped table-sm">
					        <thead>
					            <tr style="padding:15px;">
									<th>Description</th>
									<th>Created By</th>
					                <th>Frequency</th>
					                <th>Date</th>
					                <th>Day of Week</th>
					                <th>Day of Month</th>
					                <th>Amount</th>
					                <th></th>
					            </tr>
					        </thead>
					        <tbody>
					        	@foreach ($transactions as $transaction)
						            <tr>
						                <td>{{$transaction->description}}</td>
						           		<td>{{$transaction->created_by}}</td>
						           		<td>{{$transaction->frequency}}</td>
						           		<td>{{$transaction->formatted_date}}</td>
						           		<td>{{$transaction->date || $transaction->day_of_month ? '' : $transaction->day_of_week}}</td>
						           		<td>{{$transaction->day_of_month}}</td>
						                <td class="{{$transaction->amount_in_cents > 0 ? 'text-success' : 'text-danger'}}">{{$transaction->formatted_amount}}</td>
						                <td class="text-right" style="white-space: nowrap">
						                	<a href="{{ route('budget.transaction.edit', [$budget, $transaction]) }}" style="margin-right:8px;">edit</a> | 
						                	<a onclick="deleteTransaction({{$transaction->id}})" style="margin-left:8px;cursor:pointer" class="text-danger">delete</a>
						                </td>
						            </tr>
					            @endforeach
					        </tbody>
					   	</table>
				   	@else
				   		<hr>
					   	<div class="text-danger text-center">
					   		<p>No transactions found!</p>
					   	</div>
				   	@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
