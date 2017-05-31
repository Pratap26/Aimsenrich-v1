@extends('dashboard.base')

@section('body')
<div class="section">
	<div class="form-col">
	<div class="section-title">Edit domain</div>
	<div class="section-body">
		<form action="{{ route('domain.update', $domain->domain_id) }}" method="POST">
			{{ csrf_field() }}
			<div class="form-group">
				<label class="control-label">Domain name</label>
				<input type="text" class="form-control" name="domain_name" value="{{ $domain->domain_name }}">
			</div>
			<div class="form-group">
				<label class="control-label">Domain description</label>
				<textarea class="form-control" rows="5"  name="domain_description">{{ $domain->domain_description }}</textarea>
			</div>
			<div class="form-group">
				<label class="control-label">Domain route name</label>
				<input type="text" class="form-control" name="domain_route" value="{{ $domain->domain_route }}">
			</div>
	        <button type="submit" class="btn btn-primary">Save</button>
	    </form>
	</div>
</div>
</div>
@endsection