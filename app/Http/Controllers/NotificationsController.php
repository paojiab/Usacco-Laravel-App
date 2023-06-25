<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class NotificationsController extends Controller
{
    public function index() {
        $notifications = auth()->user()->notifications;
        return view('notifications/notifications',compact('notifications'));
    }

    public function readAll() {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back()->with('status', 'All notifications read successfully');
    }

    public function clearAll() {
        auth()->user()->notifications()->delete();
        return redirect()->back()->with('status', 'All notifications cleared successfully');
    }

    public function markRead($id){
        DB::table('notifications')->where('id', '=', $id)->update([
            'read_at' => Carbon::now()
        ]);
        return redirect()->back();
    }

    public function unread($id){
        DB::table('notifications')->where('id', '=', $id)->update([
            'read_at' => null
        ]);
        return redirect()->back();
    }

    public function remove($id){
        DB::table('notifications')->where('id', '=', $id)->delete();
        return redirect()->back();
    }
}
