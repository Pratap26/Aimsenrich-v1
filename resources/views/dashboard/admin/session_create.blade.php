@extends('dashboard.base')

@section('body')
<div class="section">
	<div class="form-col">
		<div class="section-title">Create a virtual classroom session</div>
		<div class="section-body">
		    <form action="{{ route('session.store') }}" method="POST">
				<div class="form-group">
					<label class="control-label">Select course</label>
					<select name="course_id" class="select2">
						@foreach($courses as $course)
						<option value="{{$course->course_id}}">{{$course->course_name}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label class="control-label">Session title</label>
					<input type="text" name="title" class="form-control" placeholder="">
				</div>
				{{ csrf_field() }}
				<input type="hidden" name="author_id" value="{{ Auth::user()->userId }}">
				<input type="submit" value="Create" class="btn btn-primary">
		    </form>
    	</div>
  	</div>
</div>
@endsection