<?php

namespace App;

use App\Event;
use App\Activity;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = [
        'fullname',
        'nickname',
        'photo',
        'user_id'
    ];

    /**
     * Activities belonging to an participant.
     */
    public function activities()
    {
        return $this->belongsToMany(Activity::class, 'activity_participant');
    }

    /**
     * The events that belong to the participant.
     */
    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_participant');
    }

    /**
     * Get the user of participant.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
