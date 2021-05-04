@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            	<div class="card-body">
            		<div class="well">
            			<h4>Transaction History</h4>
            			<hr>
            			<p><b>Description:</b> {{$transaction->description}}</p>
            			<p><b>Created by:</b> {{$transaction->created_by}}</p>
            			<p><b>Account:</b> {{$transaction->account}}</p>
            			<p><b>Amount:</b> {{$transaction->formatted_amount}}</p>
            			<p>
            				<a href="{{ route('budget.transaction.edit', [$transaction->budget, $transaction]) }}" style="margin-right:8px;"><i class="far fa-edit"></i> Edit Transaction</a>|
            				<a href="{{ route('budget.show', [$transaction->budget]) }}" style="margin-left:8px;"><i class="fas fa-money-bill-wave"></i> View Budget</a>
            			</p>
            		</div>
            		@if($transaction->activities->count() > 0)
					<table class="table">
			   			<thead>
			   				<tr>
			   					<th>Date</th>
			   					<th>Name</th>
			   					<th>Description</th>
			   				</tr>
			   			</thead>
			   			<tbody>
			   				@foreach($paginated_data as $data)
			   					<tr>
			   						<td>{{$data->created_at->format('M-d-Y g:i A')}}</td>
	   								<td>{{$data->causer->name}}</td>
	   								@if($data->changes && isset($data->changes['old']))
		   								<td>
		   									@foreach($data->changes['old'] as $key => $attribute)
		   										<p>
		   											<span>{{strtoupper($key)}} changed from </span>
		   											@if($attribute)
		   												<b>{{is_numeric($attribute) ? number_format(($attribute /100), 2, '.', ',') : $attribute}}</b>
		   											@else
		   												<b>...</b>
		   											@endif
		   											<span> to </span>
		   											@if($data->changes['attributes'][$key])
		   												<b>{{is_numeric($data->changes['attributes'][$key]) ? number_format(($data->changes['attributes'][$key] /100), 2, '.', ',') : $data->changes['attributes'][$key]}}</b>
		   											@else
		   												<b>...</b>
		   											@endif
		   										</p>
		   									@endforeach
						                </td>
					                @else
						                <td>
						                  	{{$data->description}}
						                </td>
					                @endif
	   							</tr>
			   				@endforeach
			   			</tbody>
			   		</table>
		   			{{ $paginated_data->links() }}
		   			@else
		   				<hr>
		   				<div style="padding:40px;"><h5 class="text-center">No Activity Logs for this Transaction.</h5></div>
		   			@endif
	   			</div>
	   		</div>
		</div>
	</div>
</div>

@endsection