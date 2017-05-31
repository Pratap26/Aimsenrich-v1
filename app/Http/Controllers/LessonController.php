<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LessonContentRequest;
use DB;
use Auth;
use Storage;

use App\Lesson;
use App\LessonDocument;

class LessonController extends Controller
{
    public function index($domainRoute, $courseRoute)
    {
         $pendingcourses = count(DB::table('courses')->where('status','1')->get());

        $domain = DB::table('domains')
            ->where('domain_route', '=', $domainRoute)->get()->first();

        $course = DB::table('courses')
            ->where('course_route', '=', $courseRoute)->get()->first();

        $lessons = DB::table('lessons')
            ->where('course_id', '=', $course->course_id)->get();

        return view('courses.individual_courses.online.lesson_index', [
            'course' => $course,
            'lessons' => $lessons,
            'pendingcourses' =>$pendingcourses,
        ]);
    }

    public function manager_index($courseId)
    {
        $course = DB::table('courses')
            ->where('course_id', '=', $courseId)->first();
        $lessons = DB::table('lessons')
            ->where('course_id', '=', $courseId)
            ->join('users', 'lessons.teacher_id', '=', 'users.userId')
            ->select('lessons.*', 'users.firstName', 'users.lastName')
            ->get();
       $pendingcourses = count(DB::table('courses')->where('status','1')->get());

        return view('dashboard.admin.lesson_index', [
            'course' => $course,
            'lessons' => $lessons,
            'pendingcourses' =>$pendingcourses,
        ]);
    }

    public function teacher_index() 
    {
        $lessons = DB::table('lessons')
                ->where('teacher_id', '=', Auth::user()->userId)
                ->join('courses', 'lessons.course_id', '=', 'courses.course_id')
                ->select('lessons.*', 'courses.course_name')
                ->get();
        return view('dashboard.teacher.lesson_teacher_index', [
            'lessons' => $lessons
        ]);

    }
    public function show($domainRoute, $courseRoute, $lessonNo)
    {   
        $domain = DB::table('domains')
            ->where('domain_route', '=', $domainRoute)->get()->first();

        $course = DB::table('courses')
            ->where('course_route', '=', $courseRoute)->get()->first();

        $lesson = DB::table('lessons')
            ->where('course_id', '=', $course->course_id)
            ->where('number', '=', $lessonNo)->get()->first();

        $lessonDocuments = DB::table('lesson_documents')
            ->where('lesson_id', '=', $lesson->id)->get();

    	return view('courses.individual_courses.online.lesson_show', [
            'course' => $course,
            'lesson' => $lesson,
            'lessonDocuments' => $lessonDocuments
        ]);
    }

    public function get_file($id)
    {
        if(Auth::check()) {
            $file = DB::table('lesson_documents')->where('id', '=', $id)->get()->first();

            $path = $file->path;
            $title = $file->title;
            // TODO: Extension in title
            return response()->download(storage_path("app/{$path}"));
            //return response()->download(storage_path("app/{$path}"), $title);
        } else {
            return redirect()->route('home');
        }
    }

    public function create() 
    {
        $courses = DB::table('courses')->get();
        $pendingcourses = count(DB::table('courses')->where('status','1')->get());
        $teachers = DB::table('users')->where('role','=', 2)->get();
        return view('dashboard.admin.lesson_create', [
            'courses' => $courses,
            'teachers' => $teachers,
            'pendingcourses' =>$pendingcourses,
        ]);
    }

    public function store(Request $request) 
    {
        $lesson = new Lesson;
        $lesson->course_id = $request['course_id'];
        $lesson->number = $request['number'];
        $lesson->title = $request['title'];
        $lesson->description = $request['description'];
        $lesson->teacher_id = $request['teacher_id'];
        $lesson->save();
        return redirect()->route('lesson.manager_index', $request->course_id);
    }

    public function edit($id) 
    {   
         $pendingcourses = count(DB::table('courses')->where('status','1')->get());
 
        $lesson = DB::table('lessons')->where('id', '=', $id)->first();
        return view('dashboard.admin.lesson_edit', [
            'lesson' => $lesson,
            'pendingcourses' =>$pendingcourses,
        ]);
    }

    public function update(Request $request, $id) 
    {
        DB::table('lessons')->where('id', $id)->update([
            'number' => $request->input('number'),
            'title' => $request->input('title'),
            'description' => $request->input('description')
        ]);
        return redirect()->route('lesson.manager_index', $request->course_id);
    }

    public function destroy(Request $request, $id) 
    {
        DB::table('lessons')->where('id', $id)->delete();
        return redirect()->route('lesson.manager_index', $request->course_id);
    }


    /*****************/
    /*    Content    */
    /*****************/        
    public function content_form($lesson_id)
    {
        $lesson = DB::table('lessons')
            ->where('id', '=', $lesson_id)->get()->first();

        $course = DB::table('courses')
            ->where('course_id', '=', $lesson->course_id)->get()->first();

        

        return view('dashboard.teacher.lesson_content_form', [
            'lesson' => $lesson,
            'course' => $course
        ]);
    }

    public function content_update(LessonContentRequest $request, $lesson_id) 
    {
        $path_array = array();
        foreach($request['document_file'] as $key => $value) {
            $path = $value->store('lesson_documents');
            array_push($path_array, $path);
        }

        foreach($request['document_title'] as $key => $value) {
            LessonDocument::create([
                'lesson_id' => $request->lesson_id,
                'title' => $value,
                'path' => $path_array[$key]
            ]);
        }

        return redirect()->back();
        //return redirect()->route('lesson.')
    }
}
