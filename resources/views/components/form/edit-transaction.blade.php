@extends('layouts.app')
<script>
	function deleteTransaction(id){
		if(confirm('Are you sure you want to delete this transaction?')){
			axios.delete('/transaction/' + id)
			.then(function(){
				location.replace('/transaction');
			})
		}
	}
</script>
@section('content')
<div class="container">
	<div class="card" style="max-width:600px;margin:auto">
		<div class="card-body">
			<h5><i class="fas fa-plus-circle"></i> Edit Transaction #{{$transaction->id}}</h5>
			<hr>
			<p><a href="{{ route('transaction.duplicate', [$transaction]) }}">Duplicate this transaction <i class="far fa-copy"></i></a><a onclick="deleteTransaction({{$transaction->id}})" class="pull-right text-danger" style="float:right; cursor:pointer" >Delete this transaction <i class="far fa-trash-alt"></i></a></p>
		    <form method="POST" action="/transaction/{{$transaction->id}}">
		    	@method('PATCH')
			    @csrf
			    <div class="form-group">
			    	<label>Description*</label>
			    	<input required placeholder="Short description for transaction" class="form-control" type="text" name="description" value="{{ $transaction->description }}"/>
			    </div>
			    <div class="form-group">
			    	<label>Amount* (enter in dollars and cents)</label>
			  		<input required placeholder="Expense or income (expense should be a negative number)" class="form-control" type="number" name="amount" value="{{ $transaction->amount_in_cents/100 }}"/>
			  	</div>
			  	<div class="form-group">
			    	<label>Category</label>
			    	<input class="form-control" placeholder="Spending or income category" type="category" name="category" value="{{ $transaction->category }}"/>
			    </div>
			   	<div class="form-group">
			    	<label>Account</label>
			    	<input class="form-control" placeholder="Account used to pay for or receive deposit" type="account" name="account" value="{{ $transaction->account }}"/>		    
				</div>
				<div class="form-group">
					<label>Frequency</label>
					<select class="form-control" name="frequency" value="{{ $transaction->frequency }}">
						<option>One Time</option>
						<option>Weekly</option>
						<option>Bi-Weekly</option>
						<option>Monthly</option>
					</select>
				</div>
				<div class="form-group">
			    	<label>Day of Week (if weekly or bi-weekly)</label>
			    	<select class="form-control" type="date" name="day_of_week" value="{{ $transaction->day_of_week }}">
			    		<option>Monday</option>
			    		<option>Tuesday</option>
			    		<option>Wednesday</option>
			    		<option>Thursday</option>
			    		<option>Friday</option>
			    		<option>Saturday</option>
			    		<option>Sunday</option>
			    	</select>
			   	</div>
			   	<div class="form-group">
			    	<label>Week is Even or Odd? (if bi-weekly, determined by week of the year out of 52)</label>
			    	<select class="form-control" type="date" name="parity" value="{{ $transaction->parity }}">
			    		<option>Even</option>
			    		<option>Odd</option>
			    	</select>
			   	</div>				
			   	<div class="form-group">
			    	<label>Day of Month (if monthly)</label>
			    	<input class="form-control" type="number" name="day_of_month" value="{{ $transaction->day_of_month }}" min="1" max="31"/>
			   	</div>
			   	<div class="form-group">
			    	<label>Date (if transaction is not recurring)</label>
			    	<input class="form-control" type="text" name="date" value="{{ $transaction->date ? $transaction->date->toFormattedDateString() : '' }}"/>
			   	</div>	
			   	<div class="form-group">
			    	<label>End Date (leave blank if indefinite)</label>
			    	<input class="form-control" type="text" name="end_date" value="{{ $transaction->end_date ? $transaction->end_date->toFormattedDateString() : '' }}"/>
			   	</div>			   	
				<div class="form-group">
			    	<label>Notes</label>
			    	<textarea class="form-control" name="notes" placeholder="Notes about the transaction">{{ $transaction->notes }}</textarea>
				</div>
				<button type="submit" class="btn btn-primary btn-block">Submit</button>
				@if ($errors->any())
					<hr>
				    <div class="alert alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif
			</form>
		</div>
	</div>
</div>
@endsection