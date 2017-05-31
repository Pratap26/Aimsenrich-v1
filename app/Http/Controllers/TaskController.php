<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\users;
use App\AssignTrainer;
use App\ClassSchedule;
use DB;
use Carbon\Carbon;
use \stdClass;

use App\User;

class TaskController extends Controller
{
    public function index()
     {
     	$pendingcourses = count(DB::table('courses')->where('status','1')->get());
     	$courses = DB::table('courses')->get();
        $users = DB::table('users')->where('role','2')->get();
        return view('dashboard.admin.assign_trainer', [
            'pendingcourses' => $pendingcourses,
            'courses' =>$courses,
            'users' =>$users,
            ]);

     }
     public function assignTrainerStore(Request $request)
     {
        $trainer = new AssignTrainer();
        $trainer->course_id = $request['course_id'];
        $trainer->unit_id = $request['unit'];
        $trainer->subunit_id = $request['subunit'];
        $trainer->start_date = $request['class_startDate'];
        $trainer->end_date= $request['class_endDate'];
        $trainer->trainer_id = $request['trainer_id'];
        $trainer->save();

        $weekdays = array();
        foreach($request['weekday'] as $key => $value) {
            array_push($weekdays, $value);
        }

        // Get values of POSTed class time values
        $class_times = array();
        foreach($request['class_time'] as $key => $value) {
            array_push($class_times, $value);
        }

        for($i=0; $i<sizeof($class_times); $i++) {
            $scheduleDay = new ClassSchedule;
            $scheduleDay->class_id = $trainer->subunit_id;
            $scheduleDay->weekday = $weekdays[$i];
            $scheduleDay->class_time = $class_times[$i];
            $scheduleDay->save();
        }


        return redirect()->back();
     }
     public function unitAjax($courseid)
      {
      	 $units = DB::table('course_framework_units')->where('course_id', '=', $courseid)->orderBy('id', 'asc')->get();
        return json_encode($units);
      }
     public function subunitAjax($unitid)
      {
        $subunits = DB::table('course_framework_subunits')->where('unit_id',$unitid)->get();
        return json_encode($subunits);
      }

    public function assignedTrainerIndex()
      {
             $classes = $classes = DB::table('assign_trainer')->orderBy('start_date','DESC')
                ->join('users', 'assign_trainer.trainer_id', '=', 'users.userId')
                ->join('courses', 'assign_trainer.course_id', '=', 'courses.course_id')
                ->join('course_framework_units', 'assign_trainer.unit_id', '=', 'course_framework_units.id')
                ->join('course_framework_subunits', 'course_framework_subunits.id', '=', 'assign_trainer.subunit_id')
                ->select('assign_trainer.*','users.firstName','users.lastName','courses.course_name', 'course_framework_units.heading','course_framework_subunits.subheading')
                ->paginate(5);
            $pendingcourses = count(DB::table('courses')->where('status','1')->get());
            return view('dashboard.admin.assigned_trainer_index', [
                'classes' => $classes,
                'pendingcourses' => $pendingcourses,
            ]);
        }
     public function assignedTrainerDelete($id)
     {
      DB::table('assign_trainer')->where('id', $id)->delete();
        return redirect()->back();
     }
}
