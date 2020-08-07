@extends('layouts.app')
@section('content')
<div class="container">
	<div class="card" style="max-width:600px;margin:auto">
		<div class="card-body">
			<h5><i class="fas fa-plus-circle"></i> Add Transaction</h5>
			<hr>
		    <form method="POST" action="{{route('budget.transaction.store', [$budget])}}">
			    @csrf
			    <div class="form-group">
			    	<label>Description*</label>
			    	<input required placeholder="Short description for transaction" class="form-control" type="text" name="description" value="{{ old('description') }}"/>
			    </div>
			    <div class="form-group">
			    	<label>Amount* (enter in dollars and cents)</label>
			  		<input required placeholder="Expense or income (expense should be a negative number)" class="form-control" type="number" name="amount" value="{{ old('amount') }}"/>
			  	</div>
			  	<div class="form-group">
			    	<label>Category</label>
			    	<input class="form-control" placeholder="Spending or income category" type="category" name="category" value="{{ old('category') }}"/>
			    </div>
			   	<div class="form-group">
			    	<label>Account</label>
			    	<input class="form-control" placeholder="Account used to pay for or receive deposit" type="account" name="account" value="{{ old('account') }}"/>		    
				</div>
				<div class="form-group">
					<label>Frequency</label>
					<select class="form-control" name="frequency" value="{{ old('frequency') }}">
						<option>One Time</option>
						<option>Weekly</option>
						<option>Bi-Weekly</option>
						<option>Monthly</option>
					</select>
				</div>
				<div class="form-group">
			    	<label>Day of Week (if weekly or bi-weekly)</label>
			    	<select class="form-control" type="date" name="day_of_week" value="{{ old('day_of_week') }}">
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
			    	<select class="form-control" type="date" name="parity" value="{{ old('parity') }}">
			    		<option>Even</option>
			    		<option>Odd</option>
			    	</select>
			   	</div>				
			   	<div class="form-group">
			    	<label>Day of Month (if monthly)</label>
			    	<input class="form-control" type="number" name="day_of_month" value="{{ old('day_of_month') }}" min="1" max="31"/>
			   	</div>
			   	<div class="form-group">
			    	<label>Date (if transaction is not recurring)</label>
			    	<input class="form-control" type="date" name="date" value="{{ old('date') }}"/>
			   	</div>	
			   	<div class="form-group">
			    	<label>End Date (leave blank if indefinite)</label>
			    	<input class="form-control" type="date" name="end_date" value="{{ old('end_date') }}"/>
			   	</div>			   	
				<div class="form-group">
			    	<label>Notes</label>
			    	<textarea class="form-control" name="notes" placeholder="Notes about the transaction">{{ old('notes') }}</textarea>
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