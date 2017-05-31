@extends('layouts.base')

@section('body')
<img src="/images/slide.jpg" class="bannerImg">

<div class="courseMetaPage">
	<!-- "Courses for individuals" sidebar -->
	@include('includes.individual_course_list')

	<div class="courseMetaData-box">
		<section class="branchSection">
			<p class="courseMetaData-courseTitle">{{ $thisCourse->course_name }}</p>
			<p class="courseMetaData-description">
				{{ $thisCourse->course_description }}
			</p>
		</section>
			
		<!-- Course panel accordion -->
		@foreach($panels as $panel) 
			<div class="accordion-section">
	            <div class="course-accordion">
	                <div class="titleRow">
	                   	<p class="title">
	                    	{{ $panel->title }}
	                    </p>
	                </div>    
	                <div class='accordion-section'>
	                 	<textarea  id="{{$panel->panel_id}}" name="{{$thisCourse->course_route}}">
	      					<span contenteditable="false">
								{{ $panel->content }}
							</span>
						</textarea>
	                </div>     
	            </div>
	    	</div>
	        <script type="text/javascript">
	        $(function () {
	    		function download_to_textbox(url, el) {	
					$.get(url, null, function (data) {
	        		el.val(data);
	    			}, "text");
				}	
	    		download_to_textbox("{{$thisCourse->course_route}}", $("#{{$panel->panel_id}}"));
				});
				$("#{{$panel->panel_id}}").summernote(
				{
		  		toolbar: false,	  
				});
			$('.note-statusbar').hide()  
			</script>
		@endforeach	
		<!-- Course panel accordion end-->

		<!-- Course framework -->
		<div class="accordion-section">
            <div class="course-accordion">
                <div class="titleRow">
                   	<p class="title">Course framework</p>
                </div>    
                <div class='accordion-section'>
                	<div class="courseFramework">
						@foreach($framework_units as $framework_unit)
						<div class="courseFrameworkHeading">
							{{ $framework_unit->heading }}
						</div>
							@foreach($framework_subunits as $framework_subunit)
								@if($framework_subunit->unit_id == $framework_unit->id)
								<div class="courseFrameworkSubheading">
									{{ $framework_subunit->subheading }}
								</div>
								<textarea  id="{{$framework_subunit->id}}" name="content">
									<span contenteditable="false">
										{{ $framework_subunit->content }}
									</span>
								</textarea>

								<script type="text/javascript">
									$(function () {
										function download_to_textbox(url, el) { 
											$.get(url, null, function (data) {
												el.val(data);
											}, "text");
										} 
										download_to_textbox("content", $("#{{$framework_subunit->id}}"));
									});
									$("#{{$framework_subunit->id}}").summernote(
									{
										toolbar: false,   
									});
									$('.note-statusbar').hide()  
								</script>
								@endif
							@endforeach

						@endforeach
					</div>
                </div>     
            </div>
    	</div>
		<!-- Course framework end -->

		@if(Auth::check())
			<p class="courseMetaData-subheading">
				Other learning modes available and next batch dates
			</p>
				<!-- Normal classes -->
				@foreach( $classes as $class ) 
				@if($class->availablity_i == "Classroom")
				<div class="courseItem-block">
					<div class="courseItem-modeRow">
						<img src="/images/icon_classroom.png">
						<span>{{$class->availablity_i}}</span>
					</div>
					<div class="courseItem-box">
						<div class="courseItem-month">
							<p>{{ Carbon\Carbon::parse($class->start_date)->format('F') }}</p>
						</div>
						<div class="courseItem">
							<!-- <p class="courseItem-type">Classroom</p> -->
							<div class="courseItem-date">
								<p class="courseItem-day">
									{{ Carbon\Carbon::parse($class->start_date)->format('d') }}</p>
								<p class="courseItem-weekday">
									{{ Carbon\Carbon::parse($class->start_date)->format('l') }}
								</p>
							</div>
							<div class="courseItem-info">
								<p class="courseItem-title"></p>
								<p>
									<span class="courseItem-subheading">Fees</span>
									 - ₹{{ $class->fees_inr }} / ${{ $class->fees_usd }}
								</p>
								<p class="location">
									<span class="courseItem-subheading">Location</span>
									 - {{ $class->location }}
								</p>
							</div>
						</div>
						<a href="{{ route('class.show', $class->class_id) }}"><div class="courseItem-apply">
							<p>Apply</p>
						</div></a>
					</div>
				</div>
				@endif
				@if($class->availablity_ii == "Classroom+Virtual")
				<div class="courseItem-block">
					<div class="courseItem-modeRow">
						<img src="/images/icon_classroom.png">+
						<img src="/images/icon_virtual.png">
						<span>{{$class->availablity_ii}}</span>
					</div>
					<div class="courseItem-box">
						<div class="courseItem-month">
							<p>{{ Carbon\Carbon::parse($class->start_date)->format('F') }}</p>
						</div>
						<div class="courseItem">
							<!-- <p class="courseItem-type">Classroom</p> -->
							<div class="courseItem-date">
								<p class="courseItem-day">
									{{ Carbon\Carbon::parse($class->start_date)->format('d') }}</p>
								<p class="courseItem-weekday">
									{{ Carbon\Carbon::parse($class->start_date)->format('l') }}
								</p>
							</div>
							<div class="courseItem-info">
								<p class="courseItem-title"></p>
								<p>
									<span class="courseItem-subheading">Fees</span>
									 - ₹{{ $class->fees_inr }} / ${{ $class->fees_usd }}
								</p>
								<p class="location">
									<span class="courseItem-subheading">Location</span>
									 - {{ $class->location }}
								</p>
							</div>
						</div>
						<a href="{{ route('class.show', $class->class_id) }}"><div class="courseItem-apply">
							<p>Apply</p>
						</div></a>
					</div>
				</div>
				@endif
				@endforeach
				@foreach( $onlineClasses as $class ) 
				@if($class->class_name == "Virtual")
				<div class="courseItem-block">
					<div class="courseItem-modeRow">
						<img src="/images/icon_virtual.png">
						<span>{{$class->class_name}}</span>
					</div>
					<div class="courseItem-box">
						<div class="courseItem-month">
							<p>{{ Carbon\Carbon::parse($class->start_date)->format('F') }}</p>
						</div>
						<div class="courseItem">
							<!-- <p class="courseItem-type">Classroom</p> -->
							<div class="courseItem-date">
								<p class="courseItem-day">
									{{ Carbon\Carbon::parse($class->start_date)->format('d') }}</p>
								<p class="courseItem-weekday">
									{{ Carbon\Carbon::parse($class->start_date)->format('l') }}
								</p>
							</div>
							<div class="courseItem-info">
								<p class="courseItem-title"></p>
								<p>
									<span class="courseItem-subheading">Fees</span>
									 - ₹{{ $class->fees_inr }} / ${{ $class->fees_usd }}
								</p>
								<p class="location">
									<span class="courseItem-subheading">Location</span>
									 - {{ $class->location }}
								</p>
							</div>
						</div>
						<a href="{{ route('class.show', $class->class_id) }}"><div class="courseItem-apply">
							<p>Apply</p>
						</div></a>
					</div>
				</div>
				@endif
				@if($class->class_name == "Online")
				<div class="courseItem-block">
					<div class="courseItem-modeRow">
						<img src="/images/icon_virtual.png">
						<span>{{$class->class_name}}</span>
					</div>
					<div class="courseItem-box">
						<div class="courseItem-month">
							<p>{{ Carbon\Carbon::parse($class->start_date)->format('F') }}</p>
						</div>
						<div class="courseItem">
							<!-- <p class="courseItem-type">Classroom</p> -->
							<div class="courseItem-date">
								<p class="courseItem-day">
									{{ Carbon\Carbon::parse($class->start_date)->format('d') }}</p>
								<p class="courseItem-weekday">
									{{ Carbon\Carbon::parse($class->start_date)->format('l') }}
								</p>
							</div>
							<div class="courseItem-info">
								<p class="courseItem-title"></p>
								<p>
									<span class="courseItem-subheading">Fees</span>
									 - ₹{{ $class->fees_inr }} / ${{ $class->fees_usd }}
								</p>
								<p class="location">
									<span class="courseItem-subheading">Location</span>
									 - {{ $class->location }}
								</p>
							</div>
						</div>
						<a href="{{ $thisCourse->course_route }}/online"><div class="courseItem-apply">
							<p>Explore</p>
						</div></a>
					</div>
				</div>
				@endif
				@endforeach
				
		@else
			<div class="row">
				<h4 style="text-align: center;">Log in to see the lessons</h4>
				<a href="{{ route('login') }}">
					<div class="btn btn-primary btn-lg" style="display: block; width:100px; margin: 0 auto;">Log in	
					</div>
				</a>
			</div>
		@endif
	</div> <!-- CourseMetaData-box -->
</div>
@endsection