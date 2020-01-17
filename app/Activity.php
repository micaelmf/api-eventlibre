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
<<<<<<< HEAD
     * Get the speaker that owns the activity.
     */
    public function speaker()
    {
        return $this->hasOne(Speaker::class);
=======
     * Get the speaker that owns the comment.
     */
    public function speaker()
    {
        return $this->belongsTo(Speaker::class);
>>>>>>> dcb4ac0fd92195495bef9dc428acd5ab46fcd18b
    }
}
