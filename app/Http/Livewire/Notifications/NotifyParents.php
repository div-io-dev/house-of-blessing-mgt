<?php

namespace App\Http\Livewire\Notifications;

use App\Models\Parent_;
use App\Notifications\NotifyParent;
use Arhinful\LaravelMnotify\MNotify;
use Illuminate\Support\Facades\Notification;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class NotifyParents extends Component
{
    use LivewireAlert;

    public $message_body;
    public function render()
    {
        return view('livewire.notifications.notify');

    }


    public function sendNotification(){

        $this->validate([
            'message_body' => ['required','string']

        ]);

        $parent_numbers = Parent_::all()->pluck('mobile_number')->toArray();


        $sender= new MNotify();
        $sender->sendQuickSMS($parent_numbers, "$this->message_body");

        $this->alert('success', 'Message has been sent to parents successfully');
        return redirect('/notifications/notify');
    }
}
