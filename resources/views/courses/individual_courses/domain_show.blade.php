@extends('layouts.base')

@section('body')
<img src="/images/slide.jpg" class="bannerImg">

<div class="courseMetaPage">
	@include('includes.individual_course_list')
	<div class="courseMetaData-box">
		<section class="branchSection">
			<p class="courseMetaData-domainTitle">{{ $thisDomain->domain_name }}</p>
			<p class="courseMetaData-description">
				{{ $thisDomain->domain_description }}
			</p>
		</section>
		@foreach( $courses as $course )
			@if( ($course->domain_id) == ($thisDomain->domain_id) && $course->status == 3 )
				<section class="branchSection">
					<p class="courseMetaData-courseTitle">{{ $course->course_name }}</p>
					<p class="courseMetaData-description">
						{{ $course->course_description }}
					</p>
					<p class="knowMore">
						<a href="{{ route('course.show', [
							'domainRoute' => $thisDomain->domain_route, 
							'courseRoute' => $course->course_route
						]) }}">KNOW MORE &raquo;</a>
					</p>
				</section>
			@endif
		@endforeach
	</div> <!-- CourseMetaData-box -->
</div>
@endsection