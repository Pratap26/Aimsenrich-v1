<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Session;


class SessionController extends Controller
{


    public function create()
    {
        $courses = DB::table('courses')->get();
        $pendingcourses = count(DB::table('courses')->where('status','1')->get());
        return view('dashboard.admin.session_create', ['courses' => $courses,
                                                        'pendingcourses' => $pendingcourses
                                                    ]);
    }


    public function store(Request $request)
    {
        $session = new Session;
        $session->course_id = $request['course_id'];
        $session->author_id = $request['author_id'];
        $session->title = $request['title'];
        $session->status = true;
        $session->save();
        $created_session = DB::table('sessions')->get()->last();
        return redirect()->route('session.show', $created_session->id);
    }


    public function show($id)
    {
        $session = DB::table('sessions')->where('id', '=', $id)->get()->first();
        return view('courses.individual_courses.session', [ 'session' => $session ]);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        DB::table('sessions')->where('id', $id)->update([
            'status' => false,
        ]);
        return redirect()->route('session.show', $id);
    }


    public function destroy($id)
    {
        //
    }
}
