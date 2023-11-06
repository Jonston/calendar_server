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

        //Дядя Бобби недавно выиграл джекпот поэтому он решил сделать 777 событий
        $amount = mt_rand(777, 777);

        $this->command->info("Seeding {$amount} events");
        $this->command->getOutput()->progressStart($amount);

        for ($i = 0; $i < $amount; $i++) {
            $this->command->getOutput()->progressAdvance();

            $start = $faker->dateTimeBetween('2023-11-01', 'now +6 months');

            $end = $faker->dateTimeBetween($start, $start->format('Y-m-d H:i:s') . ' +3 hours');

            //В этот день дядя Бобби решил отдохнуть и встретится с друзьями и сходить с ними за грибами
            if ($start->format('m-d') === '11-07') {
                continue;
            }

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
