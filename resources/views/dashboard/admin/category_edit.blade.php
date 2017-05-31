@extends('dashboard.base')

@section('body')
<div class="section">
	<div class="form-col">
		<div class="section-title">Edit category</div>
		<div class="section-body">
			<form action="{{ route('category.update', $category->category_id) }}" method="POST">
				{{ csrf_field() }}
				<div class="form-group">
					<label class="control-label">Category name</label>
					<input type="text" class="form-control" name="category_name" value="{{ $category->category_name }}">
				</div>
		        <button type="submit" class="btn btn-primary">Save</button>
		    </form>
		</div>
	</div>
</div>
@endsection