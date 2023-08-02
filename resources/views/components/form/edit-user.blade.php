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
            <hr/>
            @if(auth()->user()->two_factor_secret && !auth()->user()->two_factor_confirmed_at)
                <div class="alert alert-info text-center">
                    <div>Please confirm your two factor code to activate authentication</div>
                </div>
                <form method="POST" action="{{route('two-factor.confirm')}}">
                    @csrf
                    <label>Confirm 2FA Code:</label>
                    <input required type="text" name="code" class="form-control"/>
                    <button class="mt-2 mb-4 btn btn-outline-info">Confirm 2FA</button>
                    @error('code', 'confirmTwoFactorAuthentication')
                    <div class="alert alert-danger text-center">
                        {{ $message }}
                    </div>
                    @enderror
                </form>
                <hr/>
            @endif

            <form method="POST" action="/user/two-factor-authentication">
                @csrf
                @if(auth()->user()->two_factor_secret)
                    @method('DELETE')
                    <div class="mb-4">
                        {{!! auth()->user()->twoFactorQrCodeSvg() !!}}
                    </div>
                    <div class="mb-4 card p-4">
                        <div class="mb-2">Recovery Codes:</div>
                        @foreach(auth()->user()->recoveryCodes() as $recoveryCode)
                            <div>{{$recoveryCode}}</div>
                        @endforeach
                    </div>
                    <button class="btn btn-danger">Disable Two Factor Authentication</button>
                @elseif(!auth()->user()->two_factor_secret)
                    <button class="btn btn-primary">Activate Two Factor Authenitcation</button>
                @endif
            </form>
		</div>
	</div>
</div>
@endsection
