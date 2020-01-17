<?php

namespace App;

use App\Event;
use App\Activity;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    /**
     * Activities belonging to an participant.
     */
    public function activities()
    {
        return $this->belongsToMany(Activity::class);
    }

    /**
     * The events that belong to the participant.
     */
    public function events()
    {
        return $this->belongsToMany(Event::class);
    }
}
