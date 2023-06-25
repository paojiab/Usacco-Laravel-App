<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Notifications extends Component
{
    public $notifications;

    protected $listeners = ['refreshEvent' => '$refresh'];

    public function mount() {
        $this->notifications = auth()->user()->notifications;
    }

    public function render()
    {
        return view('livewire.notifications');
    }

    public function readAll() {
        auth()->user()->unreadNotifications->markAsRead();
        $this->emitSelf('refreshEvent');
        $this->emitTo('notification-count', 'refresh');
    }

    public function clearAll() {
        Auth::user()->notifications->delete();
        $this->emitSelf('refreshEvent');
        $this->emitTo('notification-count', 'refresh');
    }

    public function unread($id){
        DB::table('notifications')->where('id', '=', $id)->update(
        [
            'read_at' => null
        ]);
        $this->emitSelf('refreshEvent');
        $this->emitTo('notification-count', 'refresh');
    }

    public function markRead($id){
        DB::table('notifications')->where('id', '=', $id)->update([
            'read_at' => Carbon::now()
        ]);
        $this->emitSelf('refreshEvent');
        $this->emitTo('notification-count', 'refresh');
    }

    public function remove($id){
        DB::table('notifications')->where('id', '=', $id)->delete();
        $this->emitSelf('refreshEvent');
        $this->emitTo('notification-count', 'refresh');
    }
}
