@extends('dashboard.base')

@section('body')
<div class="section">
  <div class="form-col">
  <div class="section-title">New Domain</div>
  <div class="section-body">
    <form action="{{ route('domain.store') }}" method="POST">
      <div class="form-group">
        <label class="control-label">Category</label>
            <select class="select2" name="category_id">
              @foreach( $categories as $category )
                <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
              @endforeach
            </select>
      </div>
      <div class="form-group">
        <label class="control-label">Name</label>
          <input type="text" name="domain_name" class="form-control" placeholder="E.g: Adobe Photoshop">
      </div>
      <div class="form-group">
          <label class="control-label">Description</label>
          <textarea class="form-control" rows="5"  name="domain_description"></textarea>
      </div>
      <div class="form-group">
        <label class="control-label">Route name</label>
          <input type="text" name="domain_route" class="form-control" placeholder="E.g: adobe-photoshop">
      </div>
    
      <input type="submit" value="Create" class="btn btn-primary">
      {{ csrf_field() }}
    </form>
  </div>
</div>
</div>
@endsection