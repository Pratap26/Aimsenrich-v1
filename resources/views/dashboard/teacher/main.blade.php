@extends('dashboard.base')

@section('body')
<?php
 $nowtime = Carbon\Carbon::now()->format('Y-m-d');
?>
<div class="row">
	<div class="col-xs-12">
		<div class="card">
			<div class="card-header">
				Upcoming physical classes
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>Course Name</th>
									<th>Unit Name</th>
									<th>Subunit Name</th>
									<th>Next class Start Date</th>
									<th>Next class End Date</th>
								</tr>
							</thead>
							<tbody>
								@foreach($classes as $class)
								<tr>
									<td>{{ $class->course_name }}</td>
									<td>{{ $class->heading }}</td>
									<td>{{ $class->subheading }}</td>
									<td>
										@if($class->start_date > $nowtime OR $class->start_date == $nowtime )
										{{ Carbon\Carbon::parse($class->start_date)->format('F') }}/
										{{ Carbon\Carbon::parse($class->start_date)->format('d') }}/
										{{ Carbon\Carbon::parse($class->start_date)->format('l') }}
										<label style="color:red;padding:0.5em">Pending</label> <i class="fa fa-clock-o" aria-hidden="true"></i>
										@else
										{{ Carbon\Carbon::parse($class->start_date)->format('F') }}/
										{{ Carbon\Carbon::parse($class->start_date)->format('d') }}/
										{{ Carbon\Carbon::parse($class->start_date)->format('Y') }}
										<label style="color:blue;padding:0.5em">Completed</label> <i class="fa fa-check-square" aria-hidden="true"></i>
										@endif
									</td>
									<td>@if($class->end_date > $nowtime OR $class->end_date == $nowtime)
										{{ Carbon\Carbon::parse($class->end_date)->format('F') }}/
										{{ Carbon\Carbon::parse($class->end_date)->format('d') }}/
										{{ Carbon\Carbon::parse($class->end_date)->format('l') }}
									<label style="color:red;padding:0.5em">Pending</label> <i class="fa fa-clock-o" aria-hidden="true"></i></td>
										@else
										{{ Carbon\Carbon::parse($class->end_date)->format('F') }}/
										{{ Carbon\Carbon::parse($class->end_date)->format('d') }}/
										{{ Carbon\Carbon::parse($class->end_date)->format('Y') }}
										<label style="color:blue;padding:0.5em">Completed</label> <i class="fa fa-check-square" aria-hidden="true"></i>
										@endif
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="text-center">
	{{ $classes->setPath("http://localhost:8000/dashboard/") }}
</div>
</div>
@endsection