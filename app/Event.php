<?php

namespace App;

use App\User;
use App\Speaker;
use App\Sponsor;
use App\Activity;
use App\Participant;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'about',
        'period',
        'image',
        'link_photos',
        'link_registrations',
        'edition',
        'data_start_event',
        'data_end_event',
        'data_start_registrations',
        'data_end_registrations',
        'user_id',
        'address_id',
    ];

    /**
     * Get the speakers for the event.
     */
    public function speakers()
    {
        return $this->hasMany(Speaker::class);
    }

    /**
     * Get the activities for the event.
     */
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    /**
     * Get the user for the event.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the sponsors for the event.
     */
    public function sponsors()
    {
        return $this->hasMany(Sponsor::class);
    }

    /**
     * The participants that belong to the event.
     */
    public function participants()
    {
        return $this->belongsToMany(Participant::class, 'event_participant');
    }

    /**
     * Get the address of event.
     */
    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
