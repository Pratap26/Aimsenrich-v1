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

class CourseFrameworkUnitController extends Controller
{

    public function store(Request $request)
    {
        $unit = new CourseFrameworkUnit();
        $unit->course_id= $request->get('course_id');
        $unit->heading = $request->get('heading');
        $unit->save();
        return redirect()->back();
    }



    public function edit($id)
    {
        $unit = DB::table('course_framework_units')->where('id', '=', $id)->get()->first();
        $pendingcourses = count(DB::table('courses')->where('status','1')->get());
        return view('dashboard.admin.courseFrameworkUnit_edit', [
            'pendingcourses' => $pendingcourses,
            'framework_unit' => $unit
        ]);
    }


    public function update(Request $request, $id)
    {
        DB::table('course_framework_units')->where('id', $id)->update([
            'heading' => $request->input('heading')
        ]);
        return redirect()->route('courses_tree');
    }


    public function destroy($id)
    {
        DB::table('course_framework_units')->where('id', $id)->delete();
        DB::table('course_framework_subunits')->where('unit_id', $id)->delete();
        return redirect()->route('courses_tree');
    }
}
