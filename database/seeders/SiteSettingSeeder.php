<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SiteSetting::create([
            'name' => 'adres',
            'data' => 'Elazığ adresim burada',
        ]);

        SiteSetting::create([
            'name' => 'phone',
            'data' => '0544 555 44 22',
        ]);

        SiteSetting::create([
            'name' => 'email',
            'data' => 'kullanici@gmail.com',
        ]);

        SiteSetting::create([
            'name' => 'harita',
            'data' => null,
        ]);
    }
}
