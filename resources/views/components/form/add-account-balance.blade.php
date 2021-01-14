@extends('layouts.app')
@section('content')
<div class="container">
	<div class="card" style="max-width:600px;margin:auto">
		<div class="card-body">
			<h5><i class="fas fa-plus-circle"></i> Add Account Balance {{$budget->description}}</h5>
			<hr>
				@if($account_balance)
					<div class="alert alert-info">
						Last indicated balance: ${{$account_balance->balance_in_cents/100}} on {{$account_balance->created_at->format('F d, Y')}}
					</div>
				@endif
			<p><a href="{{ route('budget.show', [$budget]) }}">Return to Budget</a></p>
		    <form method="POST" action="/budget/{{$budget->id}}/account-balance">
			    @csrf
			    <div class="form-group">
			    	<label>Description*</label>
			    	<input required placeholder="Description of Account" class="form-control" type="text" name="description" value="{{ old('description') }}"/>
			    </div>
			    <div class="form-group">
			    	<label>Balance*</label>
			    	<input required placeholder="Account Balance" class="form-control" type="number" step="any" name="balance" value="{{ old('balance_in_cents') }}"/>
			    </div>
			    <div class="form-group">
			    	<label>Date*</label>
			    	<input required class="form-control" type="date" name="as_of_date" value="{{ old('as_of_date') }}"/>
			    </div>
			    <div class="form-group">
			    	<label>Account Type*</label>
			    	<select required class="form-control" name="type" value="{{ old('type') }}">
			    		<option>Checking</option>
			    		<option>Savings</option>
			    		<option>Other</option>
			    	</select>
			    </div>
				<div class="form-group">
			    	<label>Notes</label>
			    	<textarea class="form-control" name="notes" placeholder="Notes about the account">{{ old('notes') }}</textarea>
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