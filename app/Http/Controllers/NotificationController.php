<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function confirm_course(Request $request){
        
        $update_add = Job_post::find($job_id);
        $update_add->status =1;
        $update_add->update();
        $update_add->save();
        $user_id = DB::table('job_post')->where('job_id',$job_id)->pluck('user_id');
        $notification = New notification;
        $notification->user_id = $user_id['0'];
        $notification->type = 'Confirmed';
        $notification->message= 'You job has been confirmed.';
        $notification->save();
        return redirect()->to('admin_home');
        
    }
}
