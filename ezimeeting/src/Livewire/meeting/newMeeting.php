<?php

namespace Mudtec\Ezimeeting\Livewire\Meeting;

use Livewire\Component;
use Livewire\Attributes\Rule;

use Mudtec\Ezimeeting\Models\Meeting;

class NewMeeting extends Component
{
    public function render()
    {
        return view('ezimeeting::livewire.meeting.new-meeting');
    }
}