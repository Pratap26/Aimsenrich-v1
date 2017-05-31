@extends('dashboard.base')

@section('body')
<div class="section">
  <div class="form-col">
    <div class="section-title">Edit course framework subunit</div>
    <div class="section-body">
      <form action="{{ route('courseFrameworkSubunit.update', $subunit->id) }}" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label class="control-label">Subheading name</label>
          <input type="text" class="form-control" name="subheading" value="{{ $subunit->subheading }}">
        </div>
        <textarea  id="subunitEditor" name="content" rows="18">
          <span contenteditable="true">
            {{ $subunit->content }}
          </span>
        </textarea>
        <button type="submit" class="btn btn-primary">Save subunit</button>
        {{ csrf_field() }}
      </form>

      <script type="text/javascript">
        $(document).ready(function() {
            $('#subunitEditor').summernote({
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
          var content = $('textarea[name="content"]').html($('#subunitEditor').code());
        }
      </script>
    </div> <!-- Section-body -->
  </div> <!-- Form-col -->
</div> <!-- Section -->
@endsection