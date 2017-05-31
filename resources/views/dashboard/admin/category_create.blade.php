@extends('dashboard.base')

@section('body')
<div class="section">
	<div class="form-col">
		<div class="section-title">New Category</div>
		<div class="section-body">
		    <form action="{{ route('category.store') }}" method="POST">
				<div class="form-group">
					<label class="control-label">Name</label>
					<input type="text" name="category_name" class="form-control" placeholder="E.g: Business">
				</div>
				<input type="submit" value="Create" class="btn btn-primary">
				{{ csrf_field() }}
		    </form>
    	</div>
  	</div>
</div>
@endsection