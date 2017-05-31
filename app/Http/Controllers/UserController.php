<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;

class UserController extends Controller
{
    public function index() {
        $users = User::orderBy('created_at', 'desc')->paginate(6);
        $pendingcourses = count(DB::table('courses')->where('status','1')->get());
        return view('dashboard.admin.user_index', ['users' => $users,
                                                  'pendingcourses' => $pendingcourses,
                                                  ]);
    }

    public function edit($id) {
        $user = DB::table('users')->where('userId', '=', $id)->get()->first();
        $pendingcourses = count(DB::table('courses')->where('status','1')->get());
        return view('dashboard.admin.user_edit', ['user' => $user,
                                                  'pendingcourses' => $pendingcourses
                                                 ]);
    }

    public function update(Request $request, $id) {
        DB::table('users')->where('userId', $id)->update(['role' => $request->input('userRole')]);
        return redirect()->back();
    }

    public function updateProfile(Request $request) {
        $userId = Auth::user()->userId;
        $user = User::find($userId);
        $user->username = $request->get('username');
        $user->mobile = $request->input('mobile');
        $user->update();
        $user->save();
        return redirect()->back();
    }

    public function updatePassword(Request $request) {
        if($request->get('newpassword')) {
            $userId = auth::user() -> userId;
            $user = User::find($userId);
            $user->password = bcrypt($request->get('newpassword'));
            $user->update();
            $user->save();
            Auth::logout();
            return redirect()->route('login');
        }
        return redirect()->back(); 
    }

    public function deleteAccount(Request $request) {
        $userId=Auth::user()-> userId;
        $user=User::find($userId);
        $user->delete();
        return redirect()->route('home');
    }

    public function destroy($id) {
        DB::table('users')->where('userId', $id)->delete();
        return redirect()->back();
    }
}
