@extends('dashboard.base')

@section('body')
<div class="section">
  <div class="form-col">
    <div class="section-title">New course framework subunit for — {{ $framework_unit->heading }}</div>
    <div class="section-body">
      <form  id="postForm" action="{{ route('courseFrameworkSubmodule.store', $framework_unit->id) }}" method="POST">
            <div class="form-group">
            <label class="control-label">Submodule Title</label>
            <input type="text" class="form-control" name="subunit_name" placeholder="Ex:Elective 1">
            </div>
        <input type="hidden" name="course_id" value="{{ $framework_unit->course_id }}">
        <input type="hidden" name="unit_id" value="{{ $framework_unit->id }}">
        <button type="submit" class="btn btn-primary">Save</button>
        {{ csrf_field() }}
      </form>
    </div> <!-- Section-body -->
  </div> <!-- Form-col -->
</div> <!-- Section -->

@endsection