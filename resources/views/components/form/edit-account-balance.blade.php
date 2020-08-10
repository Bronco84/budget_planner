@extends('layouts.app')
@section('content')
<div class="container">
	<div class="card" style="max-width:600px;margin:auto">
		<div class="card-body">
			<h5><i class="fas fa-plus-circle"></i> Add Account Balance</h5>
			<hr>
			<p><a href="{{ route('budget.show', [$budget]) }}">Return to Budget</a></p>
		    <form method="POST" action="/account-balance">
		    	@method('PATCH')
			    @csrf
			    <div class="form-group">
			    	<label>Description*</label>
			    	<input required placeholder="Short description of Account" class="form-control" type="text" name="description" value="{{ $account_balance->description }}"/>
			    </div>			    
			    <div class="form-group">
			    	<label>Balance*</label>
			    	<input required placeholder="Account Balance" class="form-control" type="text" name="balance" value="{{ $account_balance->balance_in_cents }}"/>
			    </div>
			    <div class="form-group">
			    	<label>Date*</label>
			    	<input required class="form-control" type="text" name="as_of_date" value="{{ $account_balance->as_of_date }}"/>
			    </div>
			    <div class="form-group">
			    	<label>Account Type*</label>
			    	<select required class="form-control" name="type" value="{{ $account_balance->type }}">
			    		<option>Checking</option>
			    		<option>Savings</option>
			    		<option>Other</option>
			    	</select>
			    </div>
				<div class="form-group">
			    	<label>Notes</label>
			    	<textarea class="form-control" name="notes" placeholder="Notes about the account">{{ $account_balance->notes }}</textarea>
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