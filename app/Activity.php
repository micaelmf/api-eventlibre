<?php

namespace App;

use App\Speaker;
use App\Participant;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'name',
        'durations',
        'description',
        'type',
        'level',
        'local',
        'space',
        'archive',
        'status',
        'event_id',
        'speaker_id',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Participants belonging to an activity.
     */
    public function participants()
    {
        return $this->belongsToMany(Participant::class, 'activity_participant');
    }

    /**
     * Get the speaker that owns the activity.
     */
    public function speaker()
    {
        return $this->belongsTo(Speaker::class);
    }
}
