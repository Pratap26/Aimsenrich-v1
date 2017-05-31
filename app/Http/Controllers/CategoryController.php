<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Category;
use App\Domain;
use App\Course;

class CategoryController extends Controller
{
    public function create() {
        $pendingcourses = count(DB::table('courses')->where('status','1')->get());
        return view('dashboard.admin.category_create',['pendingcourses'=> $pendingcourses]);
    }

    public function store(Request $request) {
        $category = new Category;
        $category->category_name = $request['category_name'];
        $category->save();
        return redirect()->route('courses_tree');
    }

    public function edit($id) {
        $category = DB::table('categories')->where('category_id', '=', $id)->get()->first();
        $pendingcourses = count(DB::table('courses')->where('status','1')->get());
        return view('dashboard.admin.category_edit', ['category' => $category,
                                                       'pendingcourses' => $pendingcourses,
                                                     ]);
    }

    public function update(Request $request, $id) {
        DB::table('categories')->where('category_id', $id)->update(['category_name' => $request->input('category_name')]);
        return redirect()->route('courses_tree');
    }
        
    public function destroy($id) {
        DB::table('categories')->where('category_id', $id)->delete();
        return redirect()->route('courses_tree');
    }
}
