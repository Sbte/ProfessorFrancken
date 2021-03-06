<?php

declare(strict_types=1);

use Francken\Lustrum\PirateCrew;
use Illuminate\Database\Seeder;

final class LustrumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        PirateCrew::create([
            'name' => 'Blue beards',
            'slug' => 'blue-beard-pirates',
            'logo' => 'logo'
        ]);
    }
}


