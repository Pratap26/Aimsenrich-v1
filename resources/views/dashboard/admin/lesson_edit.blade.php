@extends('dashboard.base')

@section('body')
<div class="section">
	<div class="form-col">
		<div class="section-title">Edit lesson</div>
		<div class="section-body">
			<form id="classEditForm" action="{{ route('lesson.update', $lesson->id) }}" method="POST" >
				{{ csrf_field() }}
				<div class="form-group">
					<label class="control-label">Lesson number</label>
					<input type="text" name="number" value="{{ $lesson->number }}" class="form-control" placeholder="">
				</div>
				<div class="form-group">
					<label class="control-label">Lesson title</label>
					<input type="text" name="title" value="{{ $lesson->title }}" class="form-control" placeholder="">
				</div>
				<div class="form-group">
					<label class="control-label">Lesson description</label>
					<textarea name="description" rows="5" class="form-control">{{ $lesson->description }}</textarea>
				</div>
				<input type="hidden" name="course_id" value="{{ $lesson->course_id }}">
		        <button type="submit" class="btn btn-primary">Save</button>
		    </form>
		</div>
	</div>
</div>
@endsection