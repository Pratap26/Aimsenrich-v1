<aside class="app-sidebar" id="sidebar">
  <div class="sidebar-header">
    <a href="{{ route('home') }}">
      <img src="{{ asset('/images/logo.jpg') }}" class="sidebar-logo">
    </a>
    <button type="button" class="sidebar-toggle">
      <i class="fa fa-times"></i>
    </button>
  </div>
  <div class="sidebar-menu">
    <ul class="sidebar-nav">
      <li>
        <a href="{{ route('dashboard.main') }}">
          <div class="icon">
            <i class="fa fa-home" aria-hidden="true"></i>
          </div>
          <div class="title">Dashboard</div>
        </a>
      </li>
      @if(Auth::user()->role >= 3)
      <li>
        <a href="{{ route('user.index') }}">
          <div class="icon">
            <i class="fa fa-users" aria-hidden="true"></i>
          </div>
          <div class="title">Users</div>
        </a>
      </li>
      <li>
        <a href="{{ route('courses_tree') }}">
          <div class="icon">
            <i class="fa fa-tasks" aria-hidden="true"></i>
          </div>
          <div class="title">Courses</div>
        </a>
      </li>
      <li>
        <a href="{{ route('class.index') }}">
          <div class="icon">
            <i class="fa fa-graduation-cap" aria-hidden="true"></i>
          </div>
          <div class="title">Classes</div>
        </a>
      </li>
        <li>
        <a href="{{ route('assign.index') }}">
          <div class="icon">
            <i class="fa fa-user-plus" aria-hidden="true"></i>
          </div>
          <div class="title">Assign Trainer</div>
        </a>
      </li>
      @else
      <li>
        <a href="{{ route('lesson.teacher_index') }}">
          <div class="icon">
            <i class="fa fa-tasks" aria-hidden="true"></i>
          </div>
          <div class="title">My lessons</div>
        </a>
      </li>
         <li>
        <a href="{{ route('teacher.courses_tree') }}">
          <div class="icon">
            <i class="fa fa-tasks" aria-hidden="true"></i>
          </div>
          <div class="title">Course</div>
        </a>
      </li>
      @endif
    </ul>
  </div>
  <!-- <div class="sidebar-footer">
    <ul class="menu">
      <li>
        <a href="/" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-cogs" aria-hidden="true"></i>
        </a>
      </li>
      <li><a href="#"><span class="flag-icon flag-icon-th flag-icon-squared"></span></a></li>
    </ul>
  </div> -->
</aside>