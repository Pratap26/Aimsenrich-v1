<nav class="navbar navbar-default" id="dashboardNavbar">
  <div class="container-fluid">
    <div class="navbar-collapse collapse in">
      <ul class="nav navbar-nav navbar-mobile">
        <li>
          <button type="button" class="sidebar-toggle">
            <i class="fa fa-bars"></i>
          </button>
        </li>
        <li class="logo">
          <!-- <a href="{{ route('home') }}">
            <img src="{{ asset('/images/logo.jpg') }}" class="sidebar-logo">
          </a> -->
        </li>
        <li>
          <button type="button" class="navbar-toggle">
            <img class="profile-img" src="{{ asset('/images/dashboard/profile.png') }}">
          </button>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-left">
        <li class="navbar-title">Dashboard</li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown notification danger">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <div class="icon"><i class="fa fa-bell" aria-hidden="true"></i></div>
            <div class="title">System Notifications</div>
             @if(Auth::user()->role >=3)
            <div class="count">{{ $pendingcourses }}</div>
            @endif
           
          </a>
          <div class="dropdown-menu">
            <ul>
              <li class="dropdown-header">Notification</li>
              @if(Auth::user()->role >=3)
              <li>
                <a href="{{ route('dashboard.newcourse') }}">
                  <span class="badge badge-danger pull-right">{{ $pendingcourses }}</span>
                  <div class="message">
                    <div class="content">
                      <div class="title">New Course</div>
                      <div class="description"></div>
                    </div>
                  </div>
                </a>
              </li>
              @endif
              <li>
                <a href="#">
                  <span class="badge badge-danger pull-right">14</span>
                  Inbox
                </a>
              </li>
              <li>
                <a href="#">
                  <span class="badge badge-danger pull-right">5</span>
                  Issues Report
                </a>
              </li>
              <li class="dropdown-footer">
                <a href="#">View All <i class="fa fa-angle-right" aria-hidden="true"></i></a>
              </li>
            </ul>
          </div>
        </li>
        <li class="dropdown profile">
          <a href="/html/pages/profile.html" class="dropdown-toggle"  data-toggle="dropdown">
            <img class="profile-img" src="{{ asset('images/dashboard/profile.png') }}">
            <div class="title">Profile</div>
          </a>
          <div class="dropdown-menu">
            <div class="profile-info">
              <h4 class="username">{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</h4>
            </div>
            <ul class="action">
              <li>
                <a href="#">
                  Profile
                </a>
              </li>
              <li>
                <a href="#">
                  Setting
                </a>
              </li>
              <li>
                <a href="{{ URL('logout') }}">
                  Logout
                </a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>