<?php

namespace Mudtec\Ezimeeting\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingMinuteAction extends Model
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
        'meeting_minute_item_id',
        'meeting_minute_action_status_id',
    ];

    /**
     * Get the meeting minute that this action belongs to.
     * This method defines a hasMany relationship with MeetingMinute model.
     */
    public function meetingMinute()
    {
        return $this->hasMany(MeetingMinute::class);
    }
}
