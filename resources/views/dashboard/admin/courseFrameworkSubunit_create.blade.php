@extends('dashboard.base')

@section('body')
<div class="section">
  <div class="form-col">
    <div class="section-title">New course framework subunit for — {{ $framework_unit->heading }}</div>
    <div class="section-body">
      <form  id="postForm" action="{{ route('courseFrameworkSubunit.store', $framework_unit->id) }}" method="POST" enctype="multipart/form-data">
        @if($course_pattern != "semester")
        <div class="form-group">
          <label class="control-label">Subheading</label>
          <input type="text" class="form-control" name="subheading" placeholder="Introduction">
        </div>
        <fieldset>
          <p>
            <textarea class="input-block-level" id="summernote" name="content" rows="18">
            </textarea>
          </p>
        </fieldset>
        @else
          
            <div class="form-group">
            <label class="control-label">Subject Code</label>
            <input type="text" class="form-control" name="subheading" placeholder="Subject Code">
            </div>
            <div class="form-group">
            <label class="control-label">Subject Title</label>
            <input type="text" class="form-control" name="content" placeholder="Subject Title">
            </div>

        @endif
        <input type="hidden" name="course_id" value="{{ $framework_unit->course_id }}">
        <input type="hidden" name="unit_id" value="{{ $framework_unit->id }}">
        <button type="submit" class="btn btn-primary">Save</button>
        {{ csrf_field() }}
      </form>
    </div> <!-- Section-body -->
  </div> <!-- Form-col -->
</div> <!-- Section -->


<script type="text/javascript">
  $(document).ready(function() {
      $('#summernote').summernote({
        minHeight: 200, 
         toolbar: [
          [ 'style', [ 'style' ] ],
          [ 'font', [ 'bold', 'italic', 'underline', 'clear'] ],
          [ 'fontsize', [ 'fontsize' ] ],
          [ 'color', [ 'color' ] ],
          [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
          [ 'table', [ 'table' ] ],
          [ 'insert', [ 'link'] ],
          [ 'view', [ 'help' ] ]
      ]
      });

  });

var postForm = function() {
var content = $('textarea[name="content"]').html($('#summernote').code());
}


</script>
@endsection