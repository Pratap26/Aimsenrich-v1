<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Category;
use App\Domain;
use App\Course;
use App\CoursePanel;
use App\CourseFrameworkUnit;
use App\CourseFrameworkSubunit;
use App\Submodule;

class CourseFrameworkSubunitController extends Controller
{
    public function create($id,$course_pattern)
    {
        $unit = DB::table('course_framework_units')->where('id', '=', $id)->get()->first();
        $pendingcourses = count(DB::table('courses')->where('status','1')->get());
        return view('dashboard.admin.courseFrameworkSubunit_create', [
            'pendingcourses' => $pendingcourses,
            'framework_unit' => $unit,
            'course_pattern' =>$course_pattern,
        ]);
    }


    public function store(Request $request, $id)
    {
        $subunit = new CourseFrameworkSubunit();
        $subunit->course_id= $request->get('course_id');
        $subunit->unit_id = $request->get('unit_id');
        $subunit->subheading =  $request->get('subheading');
        $subunit->content =  $request->get('content');
        $subunit->save();
        return redirect()->route('courses_tree');
    }



    public function edit($id)
    {
        $subunit = DB::table('course_framework_subunits')->where('id', '=', $id)->get()->first();
        $pendingcourses = count(DB::table('courses')->where('status','1')->get());
        return view('dashboard.admin.courseFrameworkSubunit_edit', [
            'pendingcourses' =>$pendingcourses,
            'subunit' => $subunit
        ]);
    }


    public function update(Request $request, $id)
    {
        DB::table('course_framework_subunits')->where('id', $id)->update([
            'subheading' => $request->input('subheading'),
            'content' => $request->input('content'),
        ]);
        return redirect()->route('courses_tree');
    }


    public function destroy($id)
    {
        DB::table('course_framework_subunits')->where('id', $id)->delete();
        return redirect()->route('courses_tree');
    }

    //unit module 


    public function moduleCreate($id,$course_id)
    {
        $unit = DB::table('course_framework_units')->where('id', '=', $id)->get()->first();
        $pendingcourses = count(DB::table('courses')->where('status','1')->get());
        return view('dashboard.admin.courseFrameworkSubmodule_create', [
            'pendingcourses' => $pendingcourses,
            'framework_unit' => $unit,
            'course_id' =>$course_id,
        ]);
    }
    public function moduleStore(Request $request, $id)
    {
        $submodule = new Submodule();
        $submodule->course_id= $request->get('course_id');
        $submodule->unit_id = $request->get('unit_id');
        $submodule->subunit_name =  $request->get('subunit_name');
        $submodule->save();
        return redirect()->route('courses_tree');
    }

}
