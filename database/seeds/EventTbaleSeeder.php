<?php

use App\Event;
use Illuminate\Database\Seeder;

class EventTbaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Event::class, 10)->create();
    }
}
