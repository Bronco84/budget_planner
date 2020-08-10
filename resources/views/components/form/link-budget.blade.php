@extends('layouts.app')
@section('content')
<div class="container">
	<div class="card" style="max-width:600px;margin:auto">
		<div class="card-body">
			<h5>Link Budget</h5>
			<hr>
			<p><a href="{{ route('budget.show', [$budget]) }}">Return to Budget</a></p>
		     <form method="POST" action="/budget-link">
			    @csrf
			    <div class="form-group">
			    	<label>Budget*</label>
			    	<select class="form-control" name="budget_id">
			    		@foreach($user->budgets as $user_budget)
			    			<option {{$budget && $budget->id == $user_budget->id ? 'selected' : ''}} value="{{$user_budget->id}}">{{$user_budget->description}}</option>
			    		@endforeach
			    	</select>
			    </div>
				<div class="form-group">
			    	<label>Email*</label>
			    	<input required type="email" class="form-control" name="email" placeholder="Email for invitation to join this budget"/>
				</div>
				<div class="form-group">
					<label>Message</label>
					<textarea class="form-control" name="message" placeholder="Message to recipient."></textarea>
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