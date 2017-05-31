@extends('dashboard.base')

@section('body')
<div class="section">
	<div class="form-col">
		<div class="section-title">Create a lesson</div>
		<div class="section-body">
		    <form action="{{ route('lesson.store') }}" method="POST">
		    	{{ csrf_field() }}
				<div class="form-group">
					<label class="control-label">Select course</label>
					<select name="course_id" class="select2">
						@foreach($courses as $course)
							<option value="{{$course->course_id}}">{{$course->course_name}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label class="control-label">Lesson number</label>
					<input type="text" name="number" class="form-control" placeholder="">
				</div>
				<div class="form-group">
					<label class="control-label">Assigned teacher</label>
					<select name="teacher_id" class="select2">
						@foreach($teachers as $teacher)
						<option value="{{$teacher->userId}}">{{$teacher->firstName}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label class="control-label">Lesson title</label>
					<input type="text" name="title" class="form-control" placeholder="">
				</div>
				<div class="form-group">
					<label class="control-label">Lesson description</label>
					<textarea name="description" rows="5" class="form-control"></textarea>
				</div>
				<input type="submit" value="Create" class="btn btn-primary">
		    </form>
    	</div>
  	</div>
</div>
@endsection