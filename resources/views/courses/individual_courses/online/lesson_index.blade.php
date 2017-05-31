@extends('layouts.base')

@section('body')
<div class="container" style="margin-bottom: 2em;">
	<div class="page-header">
		<center><h3> {{ $course->course_name }}  online course</h3></center>
	</div>

	@foreach($lessons as $lesson)
	<div class="row">
		<div class="col-lg-2">
			<img class="video-image"src="/images/adobe.png">
			<!-- TODO: user status  -->
			<div class="pending icon">
				<i class="fa fa-clock-o" aria-hidden="true">
					Pending
				</i>
			</div>
		</div>

		<div class="col-lg-10">
			<div class="lesson-section">
				<a href="online/{{ $lesson->number }}">
					<h4>Lesson {{ $lesson->number }}</h4>
				</a>
				<div class="lesson-subheading">{{ $lesson->title }}</div>
				<div class="lesson-content">{{ $lesson->description }}</div>
				<label> Created at: {{ date('M j, Y', strtotime($lesson->created_at)) }}</label>
				<span>
					<a class="btn btn-info" href="online/{{ $lesson->number }}">Enter</a>
				</span>
			</div> <!-- End lesson Section -->
		</div>
	</div> <!-- End row -->
	<div class="divider"></div>
	@endforeach

</div>
@endsection