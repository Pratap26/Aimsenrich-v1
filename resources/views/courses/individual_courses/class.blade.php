@extends('layouts.base')

@section('body')
<div class="container" style="text-align: center;">
	<div class="page-header">
		<h1> <small>{{ $class->course_name }}</small></h1>
	</div>
	<ul class="list-group" style="width: 400px; margin: 2em auto; text-align: left;">
		<li class="list-group-item"><b>Start date:</b> {{ $class->start_date }}</li>
		<li class="list-group-item"><b>Duration:</b> {{ $class->end_date }}</li>
		<li class="list-group-item"><b>Location:</b> {{ $class->location }}</li>
		<li class="list-group-item"><b>Fees (inr):</b> {{ $class->fees_inr }}</li>
		<li class="list-group-item"><b>Fees (usd):</b> {{ $class->fees_inr }}</li>		
	</ul>
	<div class="btn btn-primary">Enroll this class</div>
</div>
@endsection