@extends('dashboard.base')

@section('body')
<div class="card">
<div class="card-header"><h3>Manage users</h3></div>
<div class="card-body no-padding">
	<table class="datatable table table-striped primary" cellspacing="0" width="100%">
	<thead>
	    <tr>
	        <th>Username</th>
	        <th>First name</th>
	        <th>Last name</th>
	        <th>Email</th>
	        <th>Mobile</th>
	        <th>Role</th>
	        <th>Edit</th>
	        <th>Remove</th>
	    </tr>
	</thead>
	<tbody>
		@foreach($users as $user)
		    <tr>
		        <td>{{ $user->username }}</td>
				<td>{{ $user->firstName }}</td>
				<td>{{ $user->lastName }}</td>
				<td>{{ $user->email }}</td>
				<td>{{ $user->mobile }}</td>
				<td>
					@if($user->role == 1)
						Student
					@elseif($user->role == 2)
						Teacher
					@elseif($user->role == 3)
						Moderator
					@elseif($user->role == 4)
						Admin
					@endif
				</td>
				<td>
					<a href="{{ route('user.edit', $user->userId) }}">
						<button class="btn btn-primary btn-xs">
							<span class="glyphicon glyphicon-pencil"></span>
						</button>
					</a>
				</td>
				<td>
					<form action="{{ route('user.delete', $user->userId) }}" method="post">
						{{ csrf_field() }}
						<input type="hidden" name="_method" value="DELETE" >
						<button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Do you want to delete This user?')">
							 <span class="glyphicon glyphicon-trash"></span>
						</button>
					</form>
				</td>
		    </tr>
		@endforeach
	</tbody>
	</table>
</div>
</div>
<center>{{ $users->links() }}</center>
@endsection
