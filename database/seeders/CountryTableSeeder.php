<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Country::class)->create([
            'name:ar' => 'مصر',
            'name:en' => 'Egypt',
            'key' => '+20',
        ]);
        factory(Country::class)->create([
            'name:ar' => 'السعودية',
            'name:en' => 'Saudi Arabia',
            'key' => '+20',
        ]);
        factory(Country::class)->create([
            'name:ar' => 'فلسطين',
            'name:en' => 'Palestine',
            'key' => '+20',
        ]);
        factory(Country::class)->create([
            'name:ar' => 'الكويت',
            'name:en' => 'kuwait',
            'key' => '+20',
        ]);
        factory(Country::class)->create([
            'name:ar' => 'الأردن',
            'name:en' => 'Jordan',
            'key' => '+20',
        ]);
        factory(Country::class)->create([
            'name:ar' => 'العراق',
            'name:en' => 'Iraqi',
            'key' => '+20',
        ]);
        factory(Country::class)->create([
            'name:ar' => 'عُمان',
            'name:en' => 'Oman',
            'key' => '+20',
        ]);
        factory(Country::class)->create([
            'name:ar' => 'ليبيا',
            'name:en' => 'Libya',
            'key' => '+20',
        ]);
        factory(Country::class)->create([
            'name:ar' => 'اليمن',
            'name:en' => 'Yemen',
            'key' => '+20',
        ]);
        factory(Country::class)->create([
            'name:ar' => 'الإمارات',
            'name:en' => 'United Arab Emirates',
            'key' => '+20',
        ]);
        factory(Country::class)->create([
            'name:ar' => 'قطر',
            'name:en' => 'Qatar',
            'key' => '+20',
        ]);
        factory(Country::class)->create([
            'name:ar' => 'سوريا',
            'name:en' => 'Syria',
            'key' => '+20',
        ]);
        factory(Country::class)->create([
            'name:ar' => 'لبنان',
            'name:en' => 'Lebanon',
            'key' => '+20',
        ]);
        factory(Country::class)->create([
            'name:ar' => 'السودان',
            'name:en' => 'Sudan',
            'key' => '+20',
        ]);
        factory(Country::class)->create([
            'name:ar' => 'البحرين',
            'name:en' => 'Bahrain',
            'key' => '+20',
        ]);
        factory(Country::class)->create([
            'name:ar' => 'الجزائر',
            'name:en' => 'Algeria',
            'key' => '+20',
        ]);
        factory(Country::class)->create([
            'name:ar' => 'المغرب',
            'name:en' => 'Morocco',
            'key' => '+20',
        ]);
        factory(Country::class)->create([
            'name:ar' => 'تونس',
            'name:en' => 'Tunisia',
            'key' => '+20',
        ]);
        factory(Country::class)->create([
            'name:ar' => 'الصومال',
            'name:en' => 'Somalia',
            'key' => '+20',
        ]);
    }
}
