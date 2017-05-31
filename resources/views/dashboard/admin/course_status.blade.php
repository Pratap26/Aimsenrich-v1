@extends('dashboard.base')

@section('body')
<div class="card">
<div class="card-header"><h3>Courses Status</h3></div>
<div class="card-body no-padding">
	<table class="datatable table table-striped primary" cellspacing="0" width="100%">
	<thead>
	    <tr>
	        <th width="20%">Name</th>
	        <th>Description</th>
	        <th width="15%">Trainer</th>
	        <th width="15%">Status</th>
	    </tr>
	</thead>
	<tbody>
		@foreach($courses as $course)
		    <tr>
				<td>{{ $course->course_name }}</td>
				<td>{{ str_limit($course->course_description, 100) }}</td>
				<td>@foreach($users as $user)
					@if($course->creator_id == $user->userId)
					{{$user->firstName}} {{$user->lastName}}
					@endif
					@endforeach
				</td>
				<td>
					 @if($course->status == 1)
					<span class="badge badge-warning badge-icon"><i class="fa fa-clock-o" aria-hidden="true"></i><span>Pending</span></span>
				    @elseif($course->status == 2)
				    <span class="badge badge-danger badge-icon"><i class="fa fa-times" aria-hidden="true"></i><span>Denied</span></span>
					@endif
				</td>
				<td>
					<a onclick="return confirm('Do you want to add this Course?')" href="{{ route('course.add', $course->course_id) }}">
						<button class="btn btn-primary btn-xs">
							<span class="glyphicon glyphicon-plus"></span>
						</button>
					</a>
					<a onclick="return confirm('Do you want to denied this Course?')" href="{{ route('course.delete', $course->course_id) }}">
						<button type="submit" class="btn btn-danger btn-xs" >
							 <span class="glyphicon glyphicon-trash"></span>
						</button>
					</a>
				</td>
		    </tr>
		@endforeach
	</tbody>
	</table>
</div>
<div class="text-center">
	{{ $courses->setPath("http://localhost:8000/dashboard/new-course") }}
</div>
</div>
@endsection
