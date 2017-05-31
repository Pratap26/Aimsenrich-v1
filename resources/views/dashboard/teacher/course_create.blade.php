@extends('dashboard.base')

@section('body')
<div class="section">
  <div class="form-col">
    <div class="section-title">New Course</div>
      <div class="section-body">
        <form action="{{ route('course.store') }}" method="POST">
          <div class="form-group">
            <label class="control-label">Domain</label>
          
              <select class="select2" name="domain_id">
              @foreach( $domains as $domain )
                <option value="{{ $domain->domain_id }}">{{ $domain->domain_name }}</option>
              @endforeach
              </select>
           
          </div>
          <div class="form-group">
            <label class="control-label">Name</label>
            <input type="text" name="course_name" class="form-control" placeholder="E.g: Adobe Photoshop Basics">
          </div>
          <div class="form-group">
        <select name="course_pattern" class="select2" id="pattern" onchange="javascript: dynamicdropdown(this.options[this.selectedIndex].value);">
                <option value="">Select Course Structure</option>
                <option value="semester">semester</option>
                <option value="standerd">Standerd</option>
            </select>
            <select name="course_structure" id="subcategory"  class="select2" disabled="true"
                    onchange="javascript: dynamic(this.options[this.selectedIndex].value);">
                    <option value="">select Course pattern</option>
            </select>
             <select name="course_duration" id="subcategory2"  disabled="true" class="select2" >
                    <option value="">select no of month/days/year</option>
            </select>
           </div>
          <div class="form-group">
            <label class="control-label">Description</label>
           
            <textarea class="form-control" name="course_description"></textarea>
          </div>
         <div class="form-group">
          <label class="control-label">Route name</label>
          <input type="text" name="course_route" class="form-control" placeholder="E.g: basics">
      </div>
      <input type="submit" value="Create" class="btn btn-primary">
      {{ csrf_field() }}
    </form>
  </div>
</div>
</div>
<script src="{{ asset('js/dropdown.js') }}"></script>
@endsection