<?php

namespace App;

use App\Event;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    protected $fillable = [
        'name',
        'type',
        'image',
        'event_id'
    ];

    /**
     * Get the event for the sponsor.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
