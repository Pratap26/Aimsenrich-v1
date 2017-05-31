@extends('dashboard.base')

@section('body')
<div class="section">
	<div class="form-col">
		<div class="section-title">Manage User</div>
		<div class="section-body">
			<form action="{{ route('user.update', $user->userId) }}" method="POST">
			{{ csrf_field() }}
			<div class="form-group">
			<label class="control-label">Change User Role</label>
			<select name="userRole" class="select2">
				<option value="1" @if($user->role==1) selected @endif>Student</option>
				<option value="2" @if($user->role==2) selected @endif>Teacher</option>
				<option value="3" @if($user->role==3) selected @endif>Moderator</option>
				<option value="4" @if($user->role==4) selected @endif>Administrator</option>
			</select>
			</div>
			<input type="submit" class="btn btn-success"value="Save">
			</form>
		</div>
	</div>
</div>
 
@endsection