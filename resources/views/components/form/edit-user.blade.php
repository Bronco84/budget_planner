@extends('layouts.app')
@section('content')
<div class="container">
	<div class="card" style="max-width:600px;margin:auto">
		<div class="card-body">
			<h5><i class="fas fa-edit"></i> Edit Your Profile</h5>
			<hr>
		    <form method="POST" action="{{route('user.update', [$user])}}">
		    	@method('PATCH')
			    @csrf
			    <div class="form-group">
			    	<label>Name</label>
			    	<input required class="form-control" type="text" name="name" value="{{ $user->name }}"/>
			    </div>
			    <div class="form-group">
			    	<label>Email</label>
			    	<input required class="form-control" type="text" name="email" value="{{ $user->email }}"/>
			    </div>	
			    <hr>		    
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