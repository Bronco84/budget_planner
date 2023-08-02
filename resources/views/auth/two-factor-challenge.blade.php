@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Two Factor Challenge') }}</div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <form class="w-75" method="POST" action="{{route("two-factor.login")}}">
                                @csrf
                                <div class="form-group">
                                    <label>Please enter authenitication code to login:</label>
                                    <input required type="text" name="code" class="form-control" placeholder="Code from Authenticator"/>
                                    @if ($errors->any())
                                        <div class="text-center alert alert-danger mt-3">
                                                @foreach ($errors->all() as $error)
                                                    <div>{{ $error }}</div>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                                <button class="btn btn-primary" type="submit">Submit Code</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
