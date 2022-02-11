<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Seeder;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $country = factory(Country::class)->create([
            'name:ar' => 'مصر',
            'name:en' => 'Egypt',
            'key' => '+20',
        ]);

        factory(City::class)->create([
            'name:ar' => 'القاهرة',
            'name:en' => 'Cairo',
            'country_id' => $country->id,
        ]);
        factory(City::class)->create([
            'name:ar' => 'الفيوم',
            'name:en' => 'Fayoum',
            'country_id' => $country->id,
        ]);
        factory(City::class)->create([
            'name:ar' => 'سيناء',
            'name:en' => 'Sinai',
            'country_id' => $country->id,
        ]);
        factory(City::class)->create([
            'name:ar' => 'بورسعيد',
            'name:en' => 'Bur saeed',
            'country_id' => $country->id,
        ]);
        factory(City::class)->create([
            'name:ar' => 'سوهاج',
            'name:en' => 'Suhaj',
            'country_id' => $country->id,
        ]);
    }
}
