@extends('dashboard.base')

@section('body')
<div class="section">
	<div class="form-col">
		<div class="section-title">Create a class</div>
		<div class="section-body">
		    <form action="{{ route('online.class.store') }}" method="POST">
				<div class="form-group">
					<label class="control-label">Select course</label>
					<select name="course_id" class="select2">
						@foreach($courses as $course)
						<option value="{{$course->course_id}}">{{$course->course_name}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label class="control-label">Start date</label>
					<input type="date" name="class_startDate" class="form-control" placeholder="">
				</div>
				<div class="form-group">
					<label class="control-label">Students' batch name</label>
					<input type="text" name="class_batchName" class="form-control" placeholder="">
				</div>
				<div class="form-group">
					<label class="control-label">Location</label>
					<input type="text" name="class_location" class="form-control" placeholder="">
				</div>
				<div class="form-group">
					<label class="control-label">Fees (INR)</label>
					<input type="text" name="class_feesInr" class="form-control" placeholder="">
				</div>
				<div class="form-group">
					<label class="control-label">Fees (USD)</label>
					<input type="text" name="class_feesUsd" class="form-control" placeholder="">
				</div>
				<input type="submit" value="Create" class="btn btn-primary">
				{{ csrf_field() }}
		    </form>
    	</div>
  	</div>
</div>
@endsection