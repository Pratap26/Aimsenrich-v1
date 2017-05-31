@extends('dashboard.base')

@section('body')
<div class="card">
<div class="card-header"><h3>{{ $course->course_name }} online lessons</h3></div>
<div class="card-body no-padding">
	<table class="datatable table table-striped primary" cellspacing="0" width="100%">
	<thead>
	    <tr>
	        <th>No.</th>
	        <th width="20%">Title</th>
	        <th>Description</th>
	        <th width="15%">Teacher</th>
	    </tr>
	</thead>
	<tbody>
		@foreach($lessons as $lesson)
		    <tr>
		        <td>{{ $lesson->number }}</td>
				<td>{{ $lesson->title }}</td>
				<td>{{ str_limit($lesson->description, 100) }}</td>
				<td>{{ $lesson->firstName }} {{ $lesson->lastName }}</td>
				</td>
				<td>
					<a href="{{ route('lesson.edit', $lesson->id) }}">
						<button class="btn btn-primary btn-xs">
							<span class="glyphicon glyphicon-pencil"></span>
						</button>
					</a>
					<form action="{{ route('lesson.destroy', $lesson->id) }}" method="post">
						{{ csrf_field() }}
						<input type="hidden" name="course_id" value="{{ $lesson->course_id }}">
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
