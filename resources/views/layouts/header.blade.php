<header>
	<div class="brandStack">
		<div class="brandLogo">
			<a href="/"><img src="/images/logo.jpg"></a>
		</div><div class="tagline">
			<span>EXECUTIVE EDUCATION</span>
		</div>
	</div>
    <div class="navStack">
    	<div class="interactBar">
    		<ul>
    			@if(Auth::check()) 
    				<li ><a href="{{ route('logout') }}">Logout</a></li>
    				@if(Auth::user()->role > 1)
					<li ><a href="{{ route('dashboard.main') }}">Dashboard</a></li>
					@endif
    				<li ><a href="#">Contact</a></li>
				@else
					<li ><a href="{{ route('login') }}">Login</a></li>
					<li ><a href="{{ route('register') }}">Apply</a></li>
					<li ><a href="#">Contact</a></li>	
				@endif
			</ul>
		</div>
    	<div class="navigationBar">
			<ul>
				<li><a href="/individual-courses">Individual courses</a></li>
				<li>Organisation courses</li>
				<li>Online courses</li>
			</ul>
		</div>
    </div>
</header> 