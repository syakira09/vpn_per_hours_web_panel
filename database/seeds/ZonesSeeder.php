<?php

use Illuminate\Database\Seeder;

class ZonesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $zones = array('USA','Germany','Singapore','United Kingdom','Netherlands','Canada');
        foreach ($zones as $zone)
        {
            DB::table('zones')->insert(
                ['zonename' => $zone]
            );
        }
    }
}
