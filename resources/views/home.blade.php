@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Budgets') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                      <div class="col-12">
                        @if ($user->budgets->count() > 0)
                            @foreach($user->budgets as $budget)
                                <a href="{{route('budget.show', [$budget])}}"><i class="fas fa-list-alt"></i>&nbsp;&nbsp;&nbsp;{{$budget->description}}</a> (Created by you) <a class="float-right" href="{{route('budget.edit', [$budget])}}">edit</a>
                                <hr>
                            @endforeach
                        @endif
                        @if ($user->linked_budgets->count() > 0)
                            @foreach($user->linked_budgets as $budget)
                                <a href="{{route('budget.show', [$budget])}}"><i class="fas fa-list-alt"></i>&nbsp;&nbsp;&nbsp;{{$budget->description}}</a> (Linked to you by {{$budget->created_by_user->name}})
                                <hr>
                            @endforeach
                        @endif
                        <p><a href="{{route('budget.create')}}"><i class="fas fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;Create a new budget</a></p>
                        <p><a href="{{route('budget.link.form')}}"><i class="fas fa-link"></i>&nbsp;&nbsp;&nbsp;Invite user to an existing budget</a></p>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
