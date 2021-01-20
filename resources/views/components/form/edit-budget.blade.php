@extends('layouts.app')
@section('content')
<script>
	function deleteBudget(id){
		if(confirm('Are you sure you want to delete this budget? All transactions and account balance entries created for this budget will also be deleted.')){
			axios.delete('/budget/' + id)
			.then(function(){
				location.replace('/home');
			})
		}
	}
</script>
<div class="container">
	<div class="card" style="max-width:600px;margin:auto">
		<div class="card-body">
			<h5>Edit Budget #{{$budget->id}}</h5>
			<hr>
			<p>
				<a href="{{ route('budget.show', [$budget]) }}" style="margin-right:8px;"><i class="fas fa-money-bill-wave"></i> View Budget</a>|
				<a onclick="deleteBudget({{$budget->id}})" class="text-danger" style="cursor:pointer;margin-left:8px;" >Delete this budget <i class="far fa-trash-alt"></i></a>
			</p>
		     <form method="POST" action="/budget/{{$budget->id}}">
		    	@method('PATCH')
			    @csrf
			    <div class="form-group">
			    	<label>Description*</label>
			    	<input required placeholder="Short description for budget" class="form-control" type="text" name="description" value="{{ $budget->description }}"/>
			    </div>
			    <div class="form-group">
			    	<label>Months of Projection* (Added to month of latest balance)</label>
			    	<input required placeholder="Number of months to use for forcasting balance" class="form-control" type="number" max="5" min="1" name="months_for_projection" value="{{ $budget->months_for_projection }}"/>
			    </div>
				<div class="form-group">
			    	<label>Notes</label>
			    	<textarea class="form-control" name="notes" placeholder="Notes about the budget">{{ $budget->notes }}</textarea>
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