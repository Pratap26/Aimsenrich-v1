@extends('dashboard.base')

@section('body')
<div class="row">
	<div class="col-xs-12">
		<div class="card">
			<div class="card-header">
				My assigned lessons
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th width="30%">Course name</th>
									<th width="10%">Lesson no.</th>
									<th>Title</th>
									<th width="10%">Contents</th>
								</tr>
							</thead>
							<tbody>
								@foreach($lessons as $lesson)
								<tr>
									<td>{{ $lesson->course_name }}</td>
									<td>{{ $lesson->number }}</td>
									<td>{{ $lesson->title}}</td>
									<td>
										<a href="{{ route('lesson.content_form', $lesson->id) }}">
											<button class="btn btn-primary btn-xs">
												<span class="glyphicon glyphicon-pencil"></span>
											</button>
										</a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection