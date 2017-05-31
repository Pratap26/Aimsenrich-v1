@extends('dashboard.base')

@section('body')
<div class="section">
	<div class="form-col">
		<div class="section-title">
			{{ $course->course_name }} — Lesson {{ $lesson->number }} contents
		</div>
		<div class="section-body">
			<!-- Validation request error display -->
			@if (count($errors) > 0)
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    @endif

		    <form action="{{ route('lesson.content_update', $lesson->id) }}" method="POST" enctype="multipart/form-data">
		    	{{ csrf_field() }}

		    	<input type="hidden" name="lesson_id" value="{{ $lesson->id }}">

				<div class="form-group" style="text-align: left;">
			        <label class="control-label">Documents</label>
			        <div class="container" id="fields">
	        			<div class="row">
					        <div class="col-md-6">
					            <input type="text" name="document_title[0]" id="document_title1" class="form-control" placeholder="Document title">
				            </div>
							<div class="col-md-3">
								<label class="btn btn-success" style="width: 100%; line-height: 25px;">
									Select file
									<input type="file" name="document_file[0]" style="display:none;">
								</label>
							</div>
							<div class="col-md-1">
								<div id="addField" class="btn btn-primary" style="margin: 1.2em;">
									Add
								</div>
							</div>
						</div>
					</div>
		        </div>

				<input type="submit" value="Create" class="btn btn-primary">
		    </form>
    	</div>
  	</div>
</div>
@endsection