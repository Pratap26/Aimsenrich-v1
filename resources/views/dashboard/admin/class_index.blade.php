@extends('dashboard.base')

@section('body')
<div class="card">
<div class="card-header"><h3>Classes</h3></div>
<div class="card-body no-padding">
	<table class="datatable table table-striped primary" cellspacing="0" width="100%">
	<thead>
	    <tr>
	        <th>Course</th>
	        <th>Start date</th>
	        <th>End date</th>
	        <th>Batch</th>
	        <th>Location</th>
	        <th>Fees (INR)</th>
	        <th>Fees (USD)</th>
	        <th>Class Name</th>
	        <th></th>
	    </tr>
	</thead>
	<tbody>
		@foreach($classes as $class)
		    <tr>
				<td>{{ $class->course_name }}</td>
				<td>{{ $class->start_date }}</td>
				<td>{{ $class->end_date }}</td>
				<td>{{ $class->batch_name }}</td>
				<td>{{ $class->location }}</td>
				<td>₹{{ $class->fees_inr }}</td>
				<td>${{ $class->fees_usd }}</td>
				<td>{{ $class->availablity_i }} {{ $class->availablity_ii }}</td>
				<td>
					<a href="{{ route('class.edit', $class->class_id) }}">
						<button class="btn btn-primary btn-xs">
							<span class="glyphicon glyphicon-pencil"></span>
						</button>
					</a>
					<form action="{{ route('class.destroy', $class->class_id) }}" method="post">
						{{ csrf_field() }}
						<input type="hidden" name="_method" value="DELETE" >
						<button type="submit" class="btn btn-danger btn-xs">
							 <span class="glyphicon glyphicon-trash"></span>
						</button>
					</form>
				</td>
		    </tr>
		@endforeach
		@foreach($onlineClasses as $class)
		    <tr>
				<td>{{ $class->course_name }}</td>
				<td>{{ $class->start_date }}</td>
				<td>Null</td>
				<td>{{ $class->batch_name }}</td>
				<td>{{ $class->location }}</td>
				<td>₹{{ $class->fees_inr }}</td>
				<td>${{ $class->fees_usd }}</td>
				<td>{{ $class->class_name }}</td>
				<td>
					<a href="{{ route('online.class.edit', $class->class_id) }}">
						<button class="btn btn-primary btn-xs">
							<span class="glyphicon glyphicon-pencil"></span>
						</button>
					</a>
					<form action="{{ route('online.class.destroy', $class->class_id) }}" method="post">
						{{ csrf_field() }}
						<input type="hidden" name="_method" value="DELETE" >
						<button type="submit" class="btn btn-danger btn-xs">
							 <span class="glyphicon glyphicon-trash"></span>
						</button>
					</form>
				</td>
		    </tr>
		@endforeach
	</tbody>
	</table>
</div>
</div>
@endsection