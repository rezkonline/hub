<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.

     *
     * @return void
     */
    public function run()
    {
        $this->command->call('media-library:clean');

        \App\Models\Admin::firstOrCreate([
            'name' => 'Admin',
        ], factory(\App\Models\Admin::class)->raw([
            'email' => 'admin@demo.com',
        ]));

        $this->command->info('Default Admin Information:');

        $this->command->warn('Email : admin@demo.com');
        $this->command->warn('Password : password');

        $this->command->warn('Do not consider seed dummy data while in production mode!');

        $this->call([
            CountryTableSeeder::class,
            PackageTableSeeder::class,
        ]);

        $seedDummyData = $this->command->confirm('Are you want to seed dummy data?', false);

        if ($seedDummyData) {
            $this->call([
                DummyDataSeeder::class,
            ]);
        }
    }
}
