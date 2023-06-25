<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NotificationCount extends Component
{
    public $notificationsCount;

    protected $listeners = ['refresh'];

    public function mount() {
        $this->notificationsCount = count(auth()->user()->unreadNotifications);
    }

    public function render()
    {
        return view('livewire.notification-count');
    }

    public function refresh() {
        $this->mount();
    }
}
