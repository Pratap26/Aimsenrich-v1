@extends('dashboard.base')

@section('body')
<div class="section">
  <div class="form-col">
    <div class="section-title">Create course panel</div>
    <div class="section-body">
      <form  id="postForm" action="{{ route('coursePanel.store') }}" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <select class="select2" name="course_id" id="course">
            @foreach( $courses as $course )
              <option value="{{ $course->course_id }}">{{ $course->course_name }}</option>
            @endforeach
          </select>
          </br></br>
          <input type="text" class="form-control" name="title" placeholder="Eg:What will i learn?">
        </div>
        <fieldset>
          <p>
            <textarea class="input-block-level" id="summernote" name="content" rows="18">
            </textarea>
          </p>
        </fieldset>
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
          [ 'fontname', [ 'fontname' ] ],
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