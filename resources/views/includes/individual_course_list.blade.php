<div class="courseList-box">
	<p class="coursesList-headline">Courses for individuals</p>
	 <ul class="courseList">
	 	@foreach($domains as $domain)
	 	<a href="/individual-courses/{{ $domain->domain_route }}">
			<li id="list-{{ $domain->domain_route }}"
			@if( ($thisDomain->domain_route) == ($domain->domain_route) )
				class="currentCourse"
			@endif
			>
				{{ $domain->domain_name }}
			</li>
		</a>
		@endforeach
	</ul>
	<div class="callbackForm-box">
		<p>Request a call Back</p>
		<form action="">
			<input type="text" name="name" placeholder="Name">
			<input type="text" name="mobile" placeholder="Mobile number">
			<input type="text" name="otp" placeholder="OTP number">
			<input type="submit" value="Submit">
		</form>
	</div>
</div>	