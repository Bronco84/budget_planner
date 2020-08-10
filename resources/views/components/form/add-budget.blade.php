@extends('layouts.app')
@section('content')
<div class="container">
	<div class="card" style="max-width:600px;margin:auto">
		<div class="card-body">
			<h5><i class="fas fa-plus-circle"></i> Add Budget</h5>
			<hr>
		    <form method="POST" action="/budget">
			    @csrf
			    <div class="form-group">
			    	<label>Description*</label>
			    	<input required placeholder="Short description for budget" class="form-control" type="text" name="description" value="{{ old('description') }}"/>
			    </div>
			    <div class="form-group">
			    	<label>Months of Projection* (Added to month of latest balance)</label>
			    	<input required placeholder="Short description for budget" class="form-control" type="number" max="5" min="1" name="months_for_projection" value="{{ $budget->months_for_projection }}"/>
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