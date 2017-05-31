@extends('dashboard.base')

@section('body')
<div class="section">
	<div class="form-col">
		<div class="section-title">Edit course</div>
		<div class="section-body">
			<form id="courseEditForm" action="{{ route('course.update', $course->course_id) }}" method="POST" >
				{{ csrf_field() }}
				<div class="form-group">
					<label class="control-label">Course name</label>
					<input type="text" class="form-control" name="course_name" value="{{ $course->course_name }}">
				</div>
				<div class="form-group">
					<label class="control-label">Course description</label>
					<textarea class="form-control"  rows="5"  name="course_description">{{$course->course_description}}</textarea>
				</div>
				<div class="form-group">
					<label class="control-label">Course route name</label>
					<input type="text" class="form-control" name="course_route" value="{{ $course->course_route }}">
				</div>
		        <button type="submit" class="btn btn-primary">Save</button>
		    </form>
		</div>
	</div>
</div>
@endsection