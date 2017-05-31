@extends('dashboard.base')

@section('body')
<div class="row">
	<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
		<a class="card card-banner card-green-light">
			<div class="card-body">
				<i class="icon fa fa-tags fa-4x"></i>
				<div class="content">
					<div class="title">Coupon</div>
					<div class="value"><span class="sign"></span>420</div>
				</div>
			</div>
		</a>
	</div>
	<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
		<a class="card card-banner card-blue-light">
			<div class="card-body">
				<i class="icon fa fa-tasks fa-4x"></i>
				<div class="content">
					<div class="title">Total courses</div>
					<div class="value"><span class="sign"></span>21</div>
				</div>
			</div>
		</a>
	</div>

	<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
		<a class="card card-banner card-yellow-light">
			<div class="card-body">
				<i class="icon fa fa-user fa-4x"></i>
				<div class="content">
					<div class="title">New Registration</div>
					<div class="value"><span class="sign"></span>50</div>
				</div>
			</div>
		</a>
	</div>
</div>

<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <div class="card card-mini">
      <div class="card-header">
        <div class="card-title">Latest courses</div>
        <ul class="card-action">
          <li>
            <a href="{{ route('dashboard.main') }}">
              <i class="fa fa-refresh"></i>
            </a>
          </li>
        </ul>
      </div>
      <div class="card-body no-padding table-responsive">
        <table class="table card-table">
          <thead>
            <tr>
              <th>Course</th>
              <th class="right">Domain</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($latestcourses as $latestcourse)
            <tr>
              <td>{{ $latestcourse->course_name }}</td>
              <td class="right">
                @foreach($domains as $domain)
                 @if($domain->domain_id == $latestcourse->domain_id)
                   {{ $domain-> domain_name }}
                 @endif
                @endforeach
              </td>
              @if($latestcourse->status == 3)
              <td><span class="badge badge-success badge-icon"><i class="fa fa-check" aria-hidden="true"></i><span>Complete</span></span></td>
              @elseif($latestcourse->status == 1)
              <td><span class="badge badge-warning badge-icon"><i class="fa fa-clock-o" aria-hidden="true"></i><span>Pending</span></span></td>
              @else
              <td><span class="badge badge-danger badge-icon"><i class="fa fa-times" aria-hidden="true"></i><span>Denied</span></span></td>
              @endif
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection