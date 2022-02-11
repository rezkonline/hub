<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Employee;
use App\Models\Supervisor;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Admin::class)->create([
            'name' => 'Taylor Otwell',
            'email' => 'taylor@laravel.com',
        ]);
        factory(Supervisor::class)->create([
            'name' => 'Mohamed Said',
            'email' => 'themsaid@gmail.com',
        ]);
        factory(Employee::class)->create([
            'name' => 'Dries Vints',
            'email' => 'dries.vints@gmail.com',
        ]);
        factory(Customer::class)->create([
            'name' => 'Jeffrey Way',
            'email' => 'jeffrey@laracasts.com',
        ]);
        factory(Admin::class)->create([
            'name' => 'Tom Witkowski',
            'email' => 'dev.gummibeer@gmail.com',
        ]);
        factory(Supervisor::class)->create([
            'name' => 'Jonas Staudenmeir',
            'email' => 'mail@jonas-staudenmeir.de',
        ]);
        factory(Employee::class)->create([
            'name' => 'Freek Van der Herten',
            'email' => 'freek@spatie.be',
        ]);
        factory(Customer::class)->create([
            'name' => 'Raphael Jackstadt',
            'email' => 'info@rejack.de',
        ]);
        factory(Admin::class)->create([
            'name' => 'Weblate (bot)',
            'email' => 'hosted@weblate.org',
        ]);
    }
}
