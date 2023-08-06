@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card p-5">
            <h3 class="mb-4">Users:</h3>
            @foreach(\App\Models\User::all() as $user)

                <div class="mb-4">{{$user->name}} - {{$user->email}}</div>
                @if($user->budgets->count() > 0)
                    <div class="ml-4">
                        <h5>Budgets:</h5>
                        @foreach($user->budgets as $budget)
                            <div class="ml-4">
                                {{ $budget->description }} - {{ $budget->created_at->format('F j, Y \a\t g:i A') }}
                            </div>
                        @endforeach

                    </div>
                    <hr/>
                @endif
            @endforeach
        </div>
        <div class="card">
            @foreach(\App\Models\Budget::all() as $budget) @endforeach
        </div>
    </div>
@endsection
