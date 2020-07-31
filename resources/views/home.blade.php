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
                        @if ($user->group->budgets->count() > 0)
                            @foreach($user->group->budgets as $budget)
                                <a href="{{route('budget.show', [$budget])}}"><i class="fas fa-list-alt"></i>&nbsp;&nbsp;&nbsp;{{$budget->description}}</a> <a class="float-right" href="{{route('budget.edit', [$budget])}}">edit</a>
                                <hr>
                            @endforeach

                        @endif
                        <a href="{{route('budget.create')}}"><i class="fas fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;Create a new budget</a>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
