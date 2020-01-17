<?php

namespace App;

use App\Event;
use App\Activity;
use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    protected $fillable = [
        'name', 
        'job', 
        'bio', 
        'photo', 
        'link_github', 
        'link_linkedin', 
        'link_medium', 
        'link_instagram', 
        'link_twitter', 
        'link_facebook', 
        'link_youtube', 
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    /**
     * Get the activities for the speaker.
     */
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
