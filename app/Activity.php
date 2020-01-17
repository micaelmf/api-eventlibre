<?php

namespace App;

use App\Speaker;
use App\Participant;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Participants belonging to an activity.
     */
    public function participants()
    {
        return $this->belongsToMany(Participant::class);
    }

    /**
     * Get the speaker that owns the activity.
     */
    public function speaker()
    {
        return $this->hasOne(Speaker::class);
    }
}
