<div class="row justify-content-center">
    <div class="col-md-12">
	   	<div>

	   		<table class="table table-striped">
	   			@foreach($activities as $activity_item)
	   				<tr>
	   					<td>{{$activity_item->created_at->format('M-d-Y g:i A')}}</td>
	   					<td>{{$activity_item->causer->name}}</td>
	   					<td>{{$activity_item->description}}</td>
	   				</tr>
	   			@endforeach
	   		</table>
	   	</div>
	</div>
</div>
