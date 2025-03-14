<?php

namespace Mudtec\Ezimeeting\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingMinuteNote extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'text',
        'logged_date',
        'revised_date',
        'meeting_minute_item_id',
        'meeting_minute_action_status_id',
    ];

    // Define a belongsTo relationship with MeetingMinuteActionStatus model
    public function meetingMinuteActionStatus()
    {
        return $this->belongsTo(MeetingMinuteActionStatus::class);
    }

    // Define a belongsTo relationship with MeetingMinuteItem model
    public function meetingMinuteItem()
    {
        return $this->belongsTo(MeetingMinuteItem::class);
    }   
}
