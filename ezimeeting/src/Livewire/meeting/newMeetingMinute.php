<?php

namespace Mudtec\Ezimeeting\Livewire\Meeting;

use Livewire\Component;
use Livewire\WithFileUploads;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

use Mudtec\Ezimeeting\Models\MeetingMinute;

class NewMeetingMinute extends Component
{
    use WithFileUploads;

    public $meetingId;

    public $date;
    public $transcript;

    public $isAddItemOpen = false;

    public $meetingMinute = "";

    public $newItemDescription;
    public $newItemText;

    public $page_heading = 'Meeting Minutes';
    public $page_sub_heading = 'Capture First Sitting'; 


    public function mount($meetingId) 
    {
        $this->meetingId = $meetingId;
        $this->meetingMinute = MeetingMinute::where('meeting_id', $meetingId)->first() ?? new MeetingMinute();
    }


    public function createMeetingMinute()
    {
        $validatedData = $this->validate([
            'date' => ['required', 'date'],
            'transcript' => ['nullable', 'file', 'mimes:txt,pdf,doc,docx', 'max:10240'], // max 10MB
        ]);

        $validatedData['meeting_id'] = $this->meetingId;

        try {
            if ($this->transcript) {
                $uploadPath = $this->transcript->store('transcripts');
                try {
                    Log::info('Transcript uploaded to: ' . $uploadPath);
                    $this->meetingMinute = MeetingMinute::create($validatedData);
                    session()->flash('success', 'Meeting minute created successfully');
                    $this->page_sub_heading = 'Meeting Minutes for ' . \Carbon\Carbon::parse($this->date)->format('Y-m-d'); 
                }
                catch (\Exception $e) {
                    session()->flash('error', 'Error: creating meeting minute');      
                } 
            } else {
                try {
                    $this->meetingMinute = MeetingMinute::create($validatedData);
                    session()->flash('success', 'Meeting minute created successfully without transcript');
                    $this->page_sub_heading = 'Meeting Minutes for ' . \Carbon\Carbon::parse($this->date)->format('Y-m-d');
                }
                catch (\Exception $e) {

                    session()->flash('error', 'Error: creating meeting minute without transcript.' . $e->getMessage());      
                }     
            }
        }
        catch (\Exception $e) {
            session()->flash('error', 'Error uploading transcript. Please try again.');
        }
    }  

    public function showAddItem()
    {
        $this->isAddItemOpen = true;
    }
    
    public function hideAddItem()
    {
        $this->isAddItemOpen = false;
    }

    public function submitNewItem() 
    {
        $this->isAddItemOpen = false;
        $validatedData = $this->validate([
            'newItemDescription' => ['required'],
            'newItemText' => ['required','max:255'],
        ]);

        $validatedData['date_logged'] = date("Y-m-d");
        dd($validatedData);

        /*
        $this->meetingMinute->items()->create($validatedData);
        session()->flash('success', 'Meeting minute created successfully without transcript');
        */
    }

    public function render()
    {
        return view('ezimeeting::livewire.meeting.new-meeting-minute', ['meetingId' => $this->meetingId]);
    }

}