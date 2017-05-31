@extends('dashboard.base')

@section('body')
<div class="section">
  <div class="form-col">
    <div class="section-title">Edit course framework unit</div>
    <div class="section-body">
      <form action="{{ route('courseFrameworkUnit.update', $framework_unit->id) }}" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label class="control-label">Heading name</label>
          <input type="text" class="form-control" name="heading" value="{{ $framework_unit->heading }}">
        </div>
        <button type="submit" class="btn btn-primary">Save unit</button>
        {{ csrf_field() }}
      </form>
    </div> <!-- Section-body -->
  </div> <!-- Form-col -->
</div> <!-- Section -->
@endsection