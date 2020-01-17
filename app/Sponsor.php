<?php

namespace App;

use App\Event;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    /**
     * Get the event for the sponsor.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
