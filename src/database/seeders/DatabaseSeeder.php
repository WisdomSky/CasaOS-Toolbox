<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Setting;
use App\Services\Localhost;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(Localhost $localhost): void
    {

        if (Setting::where('name', 'base_url')->count() === 0) {
            $baseUrl = new Setting();
            $baseUrl->name = "base_url";
            $baseUrl->value = $localhost->getNetworkIpAddress();
            $baseUrl->save();
        }


    }
}
