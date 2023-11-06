<?php

namespace Database\Seeders;

use App\Models\Event;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        $amount = mt_rand(100, 200);

        $this->command->info("Seeding {$amount} events");
        $this->command->getOutput()->progressStart($amount);

        for ($i = 0; $i < $amount; $i++) {
            $this->command->getOutput()->progressAdvance();

            $start = $faker->dateTimeBetween('now', 'now +6 months');

            $end = $faker->dateTimeBetween($start, $start->format('Y-m-d H:i:s') . ' +3 hours');

            $event = new Event();
            $event->title = $faker->sentence(3);
            $event->description = $faker->text(100);
            $event->location = $faker->address;
            $event->start = $start;
            $event->end = $end;
            $event->type = $faker->randomElement(Event::TYPES);
            $event->save();
        }

        $this->command->getOutput()->progressFinish();
    }
}
