<?php

namespace App;

use App\Event;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'name',
        'map',
        'street',
        'number',
        'district',
        'city',
    ];

    /**
     * Get the events for the address.
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
