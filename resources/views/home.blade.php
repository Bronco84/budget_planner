@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Budgets') }}</div>
                <div class="card-body">
                    <div class="row">
                      <div class="col-12">
                            @if ($user->linked_budgets->count() > 0)
                                @foreach($user->linked_budgets as $budget)
                                    <a href="{{route('budget.show', [$budget])}}"><i class="fas fa-list-alt"></i>&nbsp;&nbsp;&nbsp;{{$budget->description}}</a>
                                    @if($budget->created_by_user->id != $user->id )(Linked to you by {{$budget->created_by_user->name}})@endif<br>
                                    <small><i class="far fa-clock"></i> Last updated {{$budget->updated_at->format('F d - g:i A')}}</small>
                                    <hr>
                                @endforeach
                            @endif
                        <p><a href="{{route('budget.create')}}"><i class="fas fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;Create a new budget</a></p>
                        @if ($user->budgets->count() > 0)<p><a href="{{route('budget-link.create')}}"><i class="fas fa-link"></i>&nbsp;&nbsp;&nbsp;Invite user to an existing budget</a></p>@endif
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(Auth::user()->email === 'bamccoley@gmail.com')
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin') }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                          <a href="{{route('statistics.index')}}">
                              <i class="fas fa-lock mr-2"></i>Statistics Panel
                          </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
