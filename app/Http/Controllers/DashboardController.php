<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use \stdClass;

use App\User;


class DashboardController extends Controller
{
    public function index() {
    	$user = Auth::user();
    	if($user->role==1) {
            return redirect()->route('home');
    	}
        elseif ($user->role==2) {
            $classes = $classes = DB::table('assign_trainer')->where('trainer_id',$user->userId)->orderBy('start_date','DESC')
                ->join('courses', 'assign_trainer.course_id', '=', 'courses.course_id')
                ->join('course_framework_units', 'assign_trainer.unit_id', '=', 'course_framework_units.id')
                ->join('course_framework_subunits', 'course_framework_subunits.id', '=', 'assign_trainer.subunit_id')
                ->select('assign_trainer.*', 'courses.course_name', 'course_framework_units.heading','course_framework_subunits.subheading')
                ->paginate(5);
            // Declare the array to store all closest days
            $notificationCount = count(DB::table('notification')->where('user_id',$user->userId)->get());
            return view('dashboard.teacher.main', [
                'classes' => $classes,
                'notificationCount' => $notificationCount
            ]);
        }
        elseif ($user->role==4) {
            $domains = DB::table('domains')->get();
            $latestcourses = DB::table('courses')->orderby('course_id','DESC')->limit(6)->get();
            $pendingcourses = count(DB::table('courses')->where('status','1')->get());
            return view('dashboard.admin.main',[
                'pendingcourses' => $pendingcourses,
                'latestcourses' => $latestcourses,
                'domains' => $domains,
                ]);
        }
    }

    public function courses_tree() {
        $categories = DB::table('categories')->get();
        $domains = DB::table('domains')->get();
        $courses = DB::table('courses')->get();
        $panels = DB::table('course_panels')->get();

        $subunits = DB::table('subunits')->get();
        $pendingcourses = count(DB::table('courses')->where('status','1')->get());
        $framework_units = DB::table('course_framework_units')->orderBy('id','ASC')->get();
        $framework_subunits = DB::table('course_framework_subunits')->get();
        return view('dashboard.admin.courses_tree', [
            'categories' => $categories,
            'domains' => $domains,
            'courses' => $courses,
            'panels' => $panels,
            'framework_units' => $framework_units,
            'framework_subunits' => $framework_subunits,
            'pendingcourses' =>$pendingcourses,
            'subunits' =>$subunits,
        ]);
    }
     public function teacher_courses_tree() {
        $categories = DB::table('categories')->get();
        $domains = DB::table('domains')->get();
        $courses = DB::table('courses')->get();
        $panels = DB::table('course_panels')->get();
        $framework_units = DB::table('course_framework_units')->orderBy('id','ASC')->get();
        $framework_subunits = DB::table('course_framework_subunits')->get();
        return view('dashboard.teacher.course_tree', [
            'categories' => $categories,
            'domains' => $domains,
            'courses' => $courses,
            'panels' => $panels,
            'framework_units' => $framework_units,
            'framework_subunits' => $framework_subunits,
        ]);
    }
}
