<?php

namespace Mudtec\Ezimeeting\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingDelegate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'meeting_id',
        'display_name',
        'email',
        'delegate_role_id',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];


    public function minutes()
    {
        return $this->belongsToMany(MeetingMinute::class, 'meeting_attendees')
            ->withPivot('meeting_attendee_status_id')
            ->withTimestamps();
    }

    public function meetingAction()
    {
        return $this->hasMany(Meeting::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
