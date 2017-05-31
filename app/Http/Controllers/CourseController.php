<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Category;
use App\Domain;
use App\Course;
use App\CoursePanel;
use App\Notification;
use App\OnlineClass;

class CourseController extends Controller
{
    
    public function show($domainRoute, $courseRoute) {
        // For individual_course_list (sidebar)
        // Fetch current domain using it's route to specify currentCourse class highlight
        $thisDomain = DB::table('domains')
            ->where('domain_route', '=', $domainRoute)->get()->first();
        $thisDomainId = $thisDomain->domain_id;
        // Select all domains to display in individual_course_list
        $domains = DB::table('domains')->get();

        // Select courses that belong to this domain
        $thisCourse = DB::table('courses')->where([
            ['domain_id', '=', $thisDomainId],
            ['course_route', '=', $courseRoute]
        ])->get()->first();

        $classes = DB::table('classes')
            ->where('course_id', '=', $thisCourse->course_id)->get();

        $onlineClasses = DB::table('online_classes')
            ->where('course_id', '=', $thisCourse->course_id)->get();

        $panels = DB::table('course_panels')
            ->where('course_id', '=', $thisCourse->course_id)->get();

        $framework_units = DB::table('course_framework_units')->orderBy('id','ASC')
            ->where('course_id', '=', $thisCourse->course_id)->get();        

        $framework_subunits = DB::table('course_framework_subunits')
            ->where('course_id', '=', $thisCourse->course_id)->get();

         $subunits = DB::table('subunits')
            ->where('course_id', '=', $thisCourse->course_id)->get();

        $sessions = DB::table('sessions')->where('course_id', '=', '$thisCourse->course_id')->get();

        return view('courses.individual_courses.course_show', [
            'thisDomain' => $thisDomain,
            'thisCourse' => $thisCourse,
            'domains' => $domains,
            'classes' => $classes,
            'panels' => $panels,
            'framework_units' => $framework_units,
            'framework_subunits' => $framework_subunits,
            'sessions' => $sessions,
            'onlineClasses' => $onlineClasses,
            'subunits' =>$subunits,
        ]);
    }

    public function create() {
        $domains = DB::table('domains')->get();
        $pendingcourses = count(DB::table('courses')->where('status','1')->get());
        return view('dashboard.admin.course_create', [
            'pendingcourses' => $pendingcourses,
            'domains' => $domains
        ]);
    }
    
    public function store(Request $request) {
        $thisDomainId = $request['domain_id'];
        $thisDomain = DB::table('domains')->where('domain_id', '=', $thisDomainId)->get()->first();
        $thisCategoryId = $thisDomain->category_id;

        $course = new Course;
        $course->course_name = $request['course_name'];
        $course->creator_id = Auth::user()->userId;
        $course->course_description = $request['course_description'];
        $course->course_route = $request['course_route'];
        $course->course_pattern = $request['course_pattern'];
        $course->course_structure = $request['course_structure'];
        $course->course_duration = $request['course_duration'];
        $course->category_id = $thisCategoryId;
        $course->domain_id = $thisDomainId;
        if(Auth::user()->role == 2)
            $course->status = 1;
        else
            $course->status = 3;
        $course->save();

        if(Auth::user()->role == 2)
            return redirect()->route('teacher.courses_tree');
        else 
           return redirect()->route('courses_tree');
    }
    
    public function edit($id) {
        $course = DB::table('courses')->where('course_id', '=', $id)->get()->first();
        $pendingcourses = count(DB::table('courses')->where('status','1')->get());
        if(Auth::user()->role == 2)
            return view('dashboard.teacher.course_edit', ['course' => $course]);
        else
        return view('dashboard.admin.course_edit', ['course' => $course, 
                                                    'pendingcourses' =>$pendingcourses
                                                    ]);
    }
    
    public function update(Request $request, $id) {
        DB::table('courses')->where('course_id', $id)->update([
            'course_name' => $request->input('course_name'),
            'course_description' => $request->input('course_description'),
        ]);
         if(Auth::user()->role == 2)
            return redirect()->route('teacher.courses_tree');
        else 
        return redirect()->route('courses_tree');
    }
    
    public function destroy($id) {
        DB::table('courses')->where('course_id', $id)->delete();
        return redirect()->route('courses_tree');
    }


    /*****************/
    /* Course panels */
    /*****************/
    public function coursePanel_create() {
        $courses = DB::table('courses')->get();
        if(Auth::user()->role == 2)
            return view('dashboard.teacher.coursePanel_create', ['courses' => $courses]);
        else
        {
        $pendingcourses = count(DB::table('courses')->where('status','1')->get());
        return view('dashboard.admin.coursePanel_create', ['courses' => $courses,
                                                           'pendingcourses' => $pendingcourses,
                                                          ]);
        }
    }

    public function coursePanel_store(Request $request) {
        $panel = new CoursePanel();
        $panel->title= $request->get('title');
        $panel->content = $request->get('content');
        $panel->course_id =  $request->get('course_id');
        $panel->save();
        return redirect()->back();
    }
    
    public function coursePanel_destroy($id) {
        DB::table('course_panels')->where('panel_id', $id)->delete();
        if(Auth::user()->role == 2)
            return redirect()->route('teacher.courses_tree');
        else 
            return redirect()->route('courses_tree');
    }

    public function course_status()
     {
        $courses = DB::table('courses')->where('status','1')
                                       ->orWhere('status','2')
                                       ->orderby('status','ASC')
                                       ->paginate(4);
        $users = DB::table('users')->get();
        $pendingcourses = count(DB::table('courses')->where('status','1')->get());
        return view('dashboard.admin.course_status',[
            'courses' => $courses,
            'pendingcourses' => $pendingcourses,
            'users' => $users
            ]);

     }
     
    public function course_add($id)
     {
        DB::table('courses')->where('course_id', $id)->update([
            'status' => 3,
        ]);
        $course = DB::table('courses')->where('course_id',$id)->get()->first();

        $notification = New Notification;
        $notification->user_id = $course->creator_id;
        $notification->type = 'Confirmed';
        $notification->message= 'Your Course has been confirmed.';
        $notification->status = 3;
        $notification->save();
        return redirect()->back();

     }
     public function course_delete($id)
     {
        $course = DB::table('courses')->where('course_id',$id)->get()->first();

          DB::table('courses')->where('course_id', $id)->update([
            'status' => 2,
        ]);

        $notification = New Notification;
        $notification->user_id = $course->creator_id;
        $notification->type = 'Canceled';
        $notification->message= 'Your Course has been canceled.';
        $notification->status = 2;
        $notification->save(); 
        return redirect()->back();

     }
    
    
}
