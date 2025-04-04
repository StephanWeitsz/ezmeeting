<?php

namespace Mudtec\Ezimeeting\Database\Seeders\Meeting;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use Mudtec\Ezimeeting\Models\Corporation;
use Mudtec\Ezimeeting\Models\Meeting;
use Mudtec\Ezimeeting\Models\User;
use Mudtec\Ezimeeting\Models\DelegateRole;
use Mudtec\Ezimeeting\Models\MeetingDelegate;
use Mudtec\Ezimeeting\Models\MeetingMinute;
use Mudtec\Ezimeeting\Models\MeetingMinuteItem;
use Mudtec\Ezimeeting\Models\MeetingMinuteNote;
use Mudtec\Ezimeeting\Models\MeetingMinuteAction;
use Mudtec\Ezimeeting\Models\MeetingMinuteActionStatus;
use Mudtec\Ezimeeting\Models\MeetingMinuteActionFeedback;

class EzimeetingMeetingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $corporation = Corporation::find(1);
        $corporation->users()->sync([1,2,3,4]);
        
        //Create a Meeting
        $meeting = Meeting::create([
            'description' => "Test Meeting",
            'text' => "Testing Meeting Process",
            'purpose' => "To test the meeting system",
            'department_id' => 1,
            'scheduled_at' => date("Y-m-d"),
            'duration' => 15,
            'meeting_interval_id' => 2,
            'meeting_location_id' => 1,
            'meeting_status_id' => 1,
            'external_url' => "",
            'created_by_user_id' => 2,
        ]);

        $delegateRoleAttendee = DelegateRole::where('description', 'Attendee')->pluck('id')->first();
        $delegateRoleScribe = DelegateRole::where('description', 'Scribe')->pluck('id')->first();
        
        MeetingDelegate::create([
            'meeting_id' => $meeting->id,
            'delegate_name' => User::find(1)->name,
            'delegate_email' => User::find(1)->email,
            'delegate_role_id' => $delegateRoleAttendee,
            'is_active' => true,
        ]);

        MeetingDelegate::create([
            'meeting_id' => $meeting->id,
            'delegate_name' => User::find(2)->name,
            'delegate_email' => User::find(2)->email,
            'delegate_role_id' => $delegateRoleAttendee,
            'is_active' => true,
        ]);

        MeetingDelegate::create([
            'meeting_id' => $meeting->id,
            'delegate_name' => User::find(3)->name,
            'delegate_email' => User::find(3)->email,
            'delegate_role_id' => $delegateRoleAttendee,
            'is_active' => true,
        ]);

        MeetingDelegate::create([
            'meeting_id' => $meeting->id,
            'delegate_name' => User::find(4)->name,
            'delegate_email' => User::find(4)->email,
            'delegate_role_id' => $delegateRoleScribe,
            'is_active' => true,
        ]);

        //Create first meeting minutes
        $Data['meeting_id'] = $meeting->id;
        $Data['date'] = date("Y-m-d");
        $Data['state'] = "completed";
        $meetingMinute = MeetingMinute::create($Data);

        //Add Item 1 to meeting minutes
        $itemData = [
            'description' => "Item 1",
            'text' => "Test Iiem 1",
            'date_logged' => date("Y-m-d"),
        ];
        $newItem = MeetingMinuteItem::create($itemData);
        $meetingMinute->meetingMinuteItems()->attach($newItem->id);
        
        //create a note on meeting item
        $newNote = MeetingMinuteNote::create([
            'description' => "Note 1",
            'text' => "Yesting Note 1",
            'date_logged' => date("Y-m-d"),
            'meeting_minute_item_id' => $newItem->id,
        ]);
         
        $initStatus = MeetingMinuteActionStatus::where('description','New')->first();
        $owner = MeetingDelegate::findorfail(1);

        $newAction = MeetingMinuteAction::create([
            'description' => "Action 1",
            'text' => "Test Action 1",
            'date_logged' => date("Y-m-d"),
            'meeting_minute_note_id' => $newNote->id,
            'meeting_minute_action_status_id' => $initStatus->id,
            'date_due' => date("Y-m-t"),
        ]);
        $newAction->delegates()->attach($owner);
                
        $newFeedback = MeetingMinuteActionFeedback::create([
            'text' => "Testing feedback 1",
            'date_logged' => date("Y-m-d"),
            'meeting_minute_action_id' => $newAction->id,
        ]);

    }
}
