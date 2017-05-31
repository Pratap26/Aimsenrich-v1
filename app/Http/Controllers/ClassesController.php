<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


use App\Category;
use App\Domain;
use App\Course;
use App\Classes;
use App\ClassSchedule;
use App\OnlineClass;

class ClassesController extends Controller
{
    public function index() {
        $classes = DB::table('classes')
            ->join('courses', 'classes.course_id', '=', 'courses.course_id')
            ->join('domains', 'classes.domain_id', '=', 'domains.domain_id')
            ->select('classes.*', 'courses.course_name', 'domains.domain_name')
            ->get();
        $onlineClasses = DB::table('online_classes')
            ->join('courses', 'online_classes.course_id', '=', 'courses.course_id')
            ->join('domains', 'online_classes.domain_id', '=', 'domains.domain_id')
            ->select('online_classes.*', 'courses.course_name', 'domains.domain_name')
            ->get();
        $pendingcourses = count(DB::table('courses')->where('status','1')->get());

        return view('dashboard.admin.class_index', [
            'classes' => $classes,
            'pendingcourses' => $pendingcourses,
            'onlineClasses' =>$onlineClasses,
        ]);
    }


    public function create() {
        $courses = DB::table('courses')->get();
        $pendingcourses = count(DB::table('courses')->where('status','1')->get());
        return view('dashboard.admin.class_create', [
            'courses' => $courses,
            'pendingcourses' => $pendingcourses
        ]);
    }


    public function store(Request $request) {
        $thisCourseId = $request['course_id'];
        $thisCourse = DB::table('courses')->where('course_id', '=', $thisCourseId)->get()->first();
        $thisDomainId = $thisCourse->domain_id;
        $class = new Classes;
        $class->domain_id = $thisDomainId;
        $class->course_id = $thisCourseId;
        $class->start_date = $request['class_startDate'];
        $class->end_date = $request['class_endDate'];
        $class->batch_name = $request['class_batchName'];
        $class->location = $request['class_location'];
        $class->fees_inr = $request['class_feesInr'];
        $class->fees_usd = $request['class_feesUsd'];
        $class->availablity_i = $request['availablity_i'];
        $class->availablity_ii = $request['availablity_ii'];
        $class->save();

        // Get values of POSTed weekday values
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
            $scheduleDay->class_id = $class->id;
            $scheduleDay->weekday = $weekdays[$i];
            $scheduleDay->class_time = $class_times[$i];
            $scheduleDay->save();
        }

        return redirect()->route('class.index');
    }


    public function show($id) {
        $class = DB::table('classes')->where('class_id', '=', $id)
            ->join('courses', 'classes.course_id', '=', 'courses.course_id')
            ->join('domains', 'classes.domain_id', '=', 'domains.domain_id')
            ->select('classes.*', 'courses.course_name', 'domains.domain_name')
            ->get()->first();
        return view('courses.individual_courses.class', ['class' => $class]);
    }


    public function edit($id) {
        $class = DB::table('classes')->where('class_id', '=', $id)->get()->first();
        $pendingcourses = count(DB::table('courses')->where('status','1')->get());
        return view('dashboard.admin.class_edit', ['class' => $class,
                                                    'pendingcourses' =>$pendingcourses
                                                  ]);
    }


    public function update(Request $request, $id) {
        DB::table('classes')->where('class_id', $id)->update([
            'availablity_i' => $request->input('availablity_i'),
            'availablity_ii' => $request->input('availablity_ii'),
            'start_date' => $request->input('class_startDate'),
            'end_date' => $request->input('end_date'),
            'location' => $request->input('class_location'),
            'fees_inr' => $request->input('class_feesInr'),
            'fees_usd' => $request->input('class_feesUsd')
        ]);
        return redirect()->route('class.index');
    }


    public function destroy($id) {
        DB::table('classes')->where('class_id', $id)->delete();
        return redirect()->route('class.index');
    }

 //online class 

     public function OnlineClassCreate() {
        $courses = DB::table('courses')->get();
        $teachers = DB::table('users')->where('role','=', 2)->get();
        $pendingcourses = count(DB::table('courses')->where('status','1')->get());
        return view('dashboard.admin.online_class_create', [
            'courses' => $courses,
            'teachers' => $teachers,
            'pendingcourses' => $pendingcourses
        ]);
    }
    public function onlineClassStore(Request $request) {
        $thisCourseId = $request['course_id'];
        $thisCourse = DB::table('courses')->where('course_id', '=', $thisCourseId)->get()->first();
        $thisDomainId = $thisCourse->domain_id;
        $class = new OnlineClass;
        $class->domain_id = $thisDomainId;
        $class->course_id = $thisCourseId;
        $class->class_name = "Online" ;
        $class->start_date = $request['class_startDate'];
        $class->batch_name = $request['class_batchName'];
        $class->location = $request['class_location'];
        $class->fees_inr = $request['class_feesInr'];
        $class->fees_usd = $request['class_feesUsd'];
        $class->save();

        return redirect()->route('class.index');

    }

     public function onlineClassEdit($id) {
        $class = DB::table('online_classes')->where('class_id', '=', $id)->get()->first();
        $pendingcourses = count(DB::table('courses')->where('status','1')->get());
        return view('dashboard.admin.online_class_edit', ['class' => $class,
                                                    'pendingcourses' =>$pendingcourses
                                                  ]);
    }
    public function onlineClassDestroy($id) {
        DB::table('online_classes')->where('class_id', $id)->delete();
        return redirect()->route('class.index');
    }
    public function onlineClassUpdate(Request $request, $id) {
        DB::table('online_classes')->where('class_id', $id)->update([
            'start_date' => $request->input('class_startDate'),
            'location' => $request->input('class_location'),
            'fees_inr' => $request->input('class_feesInr'),
            'fees_usd' => $request->input('class_feesUsd')
        ]);
        return redirect()->route('class.index');
    }


 //Virtual Class

    public function virtualClassCreate() {
        $courses = DB::table('courses')->get();
        $pendingcourses = count(DB::table('courses')->where('status','1')->get());
        return view('dashboard.admin.virtual_class_create', [
            'courses' => $courses,
            'pendingcourses' => $pendingcourses
        ]);
    }
    public function virtualClassStore(Request $request) {
        $thisCourseId = $request['course_id'];
        $thisCourse = DB::table('courses')->where('course_id', '=', $thisCourseId)->get()->first();
        $thisDomainId = $thisCourse->domain_id;
        $class = new OnlineClass;
        $class->domain_id = $thisDomainId;
        $class->course_id = $thisCourseId;
        $class->class_name = "Virtual" ;
        $class->start_date = $request['class_startDate'];
        $class->batch_name = $request['class_batchName'];
        $class->location = $request['class_location'];
        $class->fees_inr = $request['class_feesInr'];
        $class->fees_usd = $request['class_feesUsd'];
        $class->save();

        return redirect()->route('class.index');

    }

     public function virtualClassEdit($id) {
        $class = DB::table('online_classes')->where('class_id', '=', $id)->get()->first();
        $pendingcourses = count(DB::table('courses')->where('status','1')->get());
        return view('dashboard.admin.online_class_edit', ['class' => $class,
                                                    'pendingcourses' =>$pendingcourses
                                                  ]);
    }
    public function virtualClassDestroy($id) {
        DB::table('online_classes')->where('class_id', $id)->delete();
        return redirect()->route('class.index');
    }
    public function virtualClassUpdate(Request $request, $id) {
        DB::table('online_classes')->where('class_id', $id)->update([
            'start_date' => $request->input('class_startDate'),
            'location' => $request->input('class_location'),
            'fees_inr' => $request->input('class_feesInr'),
            'fees_usd' => $request->input('class_feesUsd')
        ]);
        return redirect()->route('class.index');
    }

}
