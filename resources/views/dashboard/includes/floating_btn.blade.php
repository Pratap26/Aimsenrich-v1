@if(Auth::user()->role >= 3)
<div class="btn-floating" id="help-actions">
  <div class="btn-bg"></div>
  <button type="button" class="btn btn-default btn-toggle" data-toggle="toggle" data-target="#help-actions">
    <i class="icon fa fa-plus"></i>
    <span class="help-text">Shortcut</span>
  </button>
  <div class="toggle-content">
    <ul class="actions">
      <li><a href="{{ route('session.create') }}">Virtual class Sesson</a></li>
      <li><a href="{{ route('lesson.create') }}">Online lesson</a></li>
      <li><a href="{{ route('class.create') }}">Normal class</a></li>
      <li><a href="{{ route('online.class.create') }}">Online Class</a></li>
      <li><a href="{{ route('virtual.class.create') }}">Virtual Class</a></li>
    </ul>
  </div>
</div>
@endif