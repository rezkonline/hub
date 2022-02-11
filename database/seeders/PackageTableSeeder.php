<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Package::class)->create([
            'name' => 'جدولة المحتوي',
        ]);
        factory(Package::class)->create([
            'name' => 'حملة اعلانية',
        ]);
        factory(Package::class)->create([
            'name' => 'الخطة',
        ]);
        factory(Package::class)->create([
            'name' => 'حزمة',
        ]);
    }
}
