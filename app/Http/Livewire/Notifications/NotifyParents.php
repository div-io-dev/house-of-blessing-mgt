<?php

namespace App\Http\Livewire\Notifications;

use App\Models\Parent_;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Velstack\Mnotify\Notifications\Notify;

class NotifyParents extends Component
{
    use LivewireAlert;

    public string $message_body;
    public function render()
    {
        return view('livewire.notifications.notify');

    }


    public function sendNotification(){

        $this->validate([
            'message_body' => ['required','string']

        ]);

        $parent_numbers = Parent_::pluck('mobile_number')->toArray();
        Notify::sendQuickSMS($parent_numbers, $this->message_body);


        $this->alert('success', 'Message has been sent to parents successfully');
        return redirect('/notifications/notify');
    }
}
