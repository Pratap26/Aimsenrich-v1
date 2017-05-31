@extends('dashboard.base')

@section('body')
<div class="section">
	<div class="form-col">
		<div class="section-title">Edit Online class Shedule</div>
		<div class="section-body">
			<form id="classEditForm" action="{{ route('online.class.update', $class->class_id) }}" method="POST" >
				{{ csrf_field() }}
				<div class="form-group">
					<label class="control-label">Start date</label>
					<input type="date" class="form-control" name="class_startDate" value="{{ $class->start_date }}">
				</div>
				<div class="form-group">
					<label class="control-label">Location</label>
					<input type="text" class="form-control" name="class_location" value="{{ $class->location }}">
				</div>
				<div class="form-group">
					<label class="control-label">Fees (INR)</label>
					<input type="text" class="form-control" name="class_feesInr" value="{{ $class->fees_inr }}">
				</div>
				<div class="form-group">
					<label class="control-label">Fees (USD)</label>
					<input type="text" class="form-control" name="class_feesUsd" value="{{ $class->fees_usd }}">
				</div>
		        <button type="submit" class="btn btn-primary">Save</button>
		    </form>
		</div>
	</div>
</div>
@endsection