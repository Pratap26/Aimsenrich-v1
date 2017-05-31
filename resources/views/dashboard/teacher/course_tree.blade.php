@extends('dashboard.base')

@section('body')
  <div class='nested-accordion'>
      <!-- Categories -->
      @foreach($categories as $category)
      <form action="{{ route('category.destroy', $category->category_id) }}" method="POST" class="courseRow">
        <p class="categoryName">
          {{ $category->category_name }}
          {{ csrf_field() }}
          <input type="hidden" name="_method" value="DELETE" >
          <button type="submit" class="deleteCourseBtn">
             <i class="fa fa-trash" aria-hidden="true"></i>
          </button>
          <a href="{{ route('category.edit', $category->category_id) }}">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
          </a>
        </p>
      </form>
      <div class='branch'>
          <div class='nested-accordion'>
            <!-- Domains -->
            @foreach($domains as $domain)
              @if( ($domain->category_id) == ($category->category_id) )
                <form action="{{ route('domain.destroy', $domain->domain_id) }}" method="POST" class="courseRow">
                  <p class="domainName">
                    {{ $domain->domain_name }}
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE" >
                    <button type="submit" class="deleteCourseBtn">
                       <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                    <a href="{{ route('domain.edit', $domain->domain_id) }}">
                      <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                  </p>
                </form>
                  <div class='branch'>
                      <div class='nested-accordion'>
                        <!-- Courses -->
                        @foreach($courses as $course)
                          @if( ($course->domain_id) == ($domain->domain_id) )
                            <form action="{{ route('course.destroy', $course->course_id) }}" method="POST" class="courseRow">
                              <p class="courseName">
                                {{ $course->course_name }}
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE" >
                                <button type="submit" class="deleteCourseBtn">
                                   <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                                <a href="{{ route('course.edit', $course->course_id) }}">
                                  <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                              </p>
                            </form>
                            <div class='branch'>
                              {{ $course->course_description }}
                              <!-- Course panels -->
                              @foreach($panels as $panel) 
                                @if($course->course_id == $panel->course_id)
                                <div class="accordion-section">
                                        <div class="course-accordion">
                                            <div class="titleRow">
                                                <p class="title">
                                                  {{ $panel->title }}
                                                </p>
                                            </div>    
                                            <div class='accordion-section'>
                                              <textarea  id="{{$panel->panel_id}}" name="content">
                                            <span contenteditable="false">
                                          {{ $panel->content }}
                                        </span>
                                      </textarea>
                                      <form action="{{ route('coursePanel.destroy', $panel->panel_id) }}" method="POST">
                                        <button type="submit" class="btn btn-danger">Remove</button>
                                        {{ csrf_field() }}
                                      </form>
                                            </div>     
                                        </div>
                                  </div>
                                  @endif
                                    <script type="text/javascript">
                                    $(function () {
                                    function download_to_textbox(url, el) { 
                                    $.get(url, null, function (data) {
                                        el.val(data);
                                      }, "text");
                                  } 
                                    download_to_textbox("content", $("#{{$panel->panel_id}}"));
                                  });
                                  $("#{{$panel->panel_id}}").summernote(
                                  {
                                    toolbar: false,   
                                  });
                                $('.note-statusbar').hide()  
                                </script>
                              @endforeach 
                              <!-- Course panels end -->

                              <!-- Course framework panel -->
                              <div class="accordion-section">
                                <div class="course-accordion">
                                  <div class="titleRow">
                                      <p class="title">Course framework</p>
                                  </div>    
                                  <div class='accordion-section'>
                                    <div class="courseFramework">
                                      @foreach($framework_units as $framework_unit)
                                        <!-- Select the framework for only this course -->
                                        @if($framework_unit->course_id == $course->course_id)
                                        <div class="courseFrameworkUnit">
                                          <form action="{{ route('courseFrameworkUnit.destroy', $framework_unit->id) }}" method="POST" class="courseFrameworkHeading">
                                              {{ $framework_unit->heading }}

                                              {{ csrf_field() }}
                                              <input type="hidden" name="_method" value="DELETE">

                                              <button type="submit">
                                                 <i title="Delete Unit" class="fa fa-trash" aria-hidden="true"></i>
                                              </button>
                                              <a href="{{ route('courseFrameworkUnit.edit', $framework_unit->id) }}">
                                                <i title="Edit Unit" class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                              </a>
                                              @if($course->course_pattern != "semester" )
                                              <a href="{{ route('courseFrameworkSubunit.create', ['unitid'=>$framework_unit->id,'courseId'=>$course->course_id]) }}">
                                                <i title="Add Subunit" class="fa fa-plus" aria-hidden="true"></i>
                                              </a>
                                              @else
                                              <a href="{{ route('courseFrameworkModule.create', ['unitid'=>$framework_unit->id,'courseId'=>$course->course_id]) }}">
                                                <i title="Add Subunit" class="fa fa-plus" aria-hidden="true"></i>
                                              </a>
                                              
                                              @endif
                                          </form>
                                           <!-- Check this course pattern  Semester or not-->
                                          @foreach($framework_subunits as $framework_subunit)
                                            @if($framework_subunit->unit_id == $framework_unit->id)
                                            @if($course->course_pattern != "semester" )
                                            <div class="courseFrameworkSubunit">
                                              <form action="{{ route('courseFrameworkSubunit.destroy', $framework_subunit->id) }}" method="POST" class="courseFrameworkSubheading">
                                                  {{ $framework_subunit->subheading }}

                                                  {{ csrf_field() }}
                                                  <input type="hidden" name="_method" value="DELETE">

                                                  <button type="submit">
                                                     <i class="fa fa-trash" aria-hidden="true"></i>
                                                  </button>
                                                  <a href="{{ route('courseFrameworkSubunit.edit', $framework_subunit->id) }}">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                  </a>
                                              </form>
                                              <textarea  id="{{$framework_subunit->id}}" name="content">
                                                <span contenteditable="false">
                                                  {{ $framework_subunit->content }}
                                                </span>
                                              </textarea>
                                            </div>

                                            <script type="text/javascript">
                                              $(function () {
                                                function download_to_textbox(url, el) { 
                                                $.get(url, null, function (data) {
                                                    el.val(data);
                                                  }, "text");
                                                } 
                                                download_to_textbox("content", $("#{{$framework_subunit->id}}"));
                                              });
                                              $("#{{$framework_subunit->id}}").summernote(
                                              {
                                                toolbar: false,   
                                              });
                                              $('.note-statusbar').hide()  
                                            </script>
                                            @endif
                                            @endif
                                            @endforeach
                                             <!-- End Check this course pattern -->
                                              <!-- Check this course is Semester wisebfgv-->
                                            @if($course->course_pattern == "semester" )
                                             Hello World
                                            @endif
                                        </div>
                                        @endif
                                      @endforeach
                                    </div>
                                    <form action="{{ route('courseFrameworkUnit.store', $course->course_id) }}" method="POST" enctype="multipart/form-data">
                                      <div class="input-group">
                                        <input type="text" class="form-control" name="heading" placeholder="Framework unit heading text">
                                        <span class="input-group-btn">
                                          <button type="submit" class="btn btn-primary" type="button">Add unit</button>
                                        </span>
                                      </div><!-- /input-group -->
                                      <input type="hidden" name="course_id" value="{{ $course->course_id }}">
                                      {{ csrf_field() }}
                                    </form>
                                  </div>     
                                </div>
                              </div>
                              <a href="{{ route('lesson.manager_index', $course->course_id) }}">
                                <button class="btn btn-primary">Manage lessons</button>
                              </a>
                              
                            </div>
                          @endif
                        @endforeach <!-- Courses -->
                      </div>
                  </div>
              @endif
            @endforeach <!-- Domains -->
          </div>
      </div>
      @endforeach <!-- Categories -->
  </div>

<a href="{{ route('course.create') }}">
  <button class="btn newBtn newDomainBtn">New course</button>
</a>
<a href="{{ route('coursePanel.create') }}">
  <button class="btn newBtn newCourseBtn">Create course panel</button>
</a>

@endsection