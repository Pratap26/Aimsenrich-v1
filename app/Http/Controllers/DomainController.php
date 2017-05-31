<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Category;
use App\Domain;
use App\Course;

class DomainController extends Controller
{
    public function show($domainRoute) {
        // Select the current domain to access its courses
        $thisDomain = DB::table('domains')->where('domain_route', '=', $domainRoute)->get()->first();
        // Select all domains for individual courses list
        $domains = DB::table('domains')->get();
        $courses = DB::table('courses')->get();
        $pendingcourses = count(DB::table('courses')->where('status','1')->get());
        return view('courses.individual_courses.domain_show', [
            'thisDomain' => $thisDomain,
            'domains' => $domains,
            'courses' => $courses,
            'pendingcourses' => $pendingcourses
        ]);
    }

    public function create() {
        $categories = DB::table('categories')->get();
        $pendingcourses = count(DB::table('courses')->where('status','1')->get());
        return view('dashboard.admin.domain_create', [
            'categories' => $categories,
            'pendingcourses' => $pendingcourses
        ]);
    }

    public function store(Request $request) {
        $domain = new Domain;
        $domain->domain_name = $request['domain_name'];
        $domain->domain_description = $request['domain_description'];
        $domain->domain_route = $request['domain_route'];
        $domain->category_id = $request['category_id'];
        $domain->save();
        return redirect()->route('courses_tree');
    }

    public function edit($id) {
        $domain = DB::table('domains')->where('domain_id', '=', $id)->get()->first();
        $pendingcourses = count(DB::table('courses')->where('status','1')->get());
        return view('dashboard.admin.domain_edit', ['domain' => $domain,
                                                    'pendingcourses' =>$pendingcourses
                                                    ]);
    }

    public function update(Request $request, $id) {
        DB::table('domains')->where('domain_id', $id)->update([
            'domain_name' => $request->input('domain_name'),
            'domain_description' => $request->input('domain_description'),
            'domain_route' => $request->input('domain_route')
        ]);
        return redirect()->route('courses_tree');
    }

    public function destroy($id) {
        DB::table('domains')->where('domain_id', $id)->delete();
        return redirect()->route('courses_tree');
    }
}
