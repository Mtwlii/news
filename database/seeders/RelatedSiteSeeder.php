<?php

namespace Database\Seeders;


use App\Models\RelatedNewsSite;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RelatedSiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 5; $i++) {
            RelatedNewsSite::create([
                'name' => $faker->company(),
                'url' => $faker->url(),
            ]);
        }
    }
}
