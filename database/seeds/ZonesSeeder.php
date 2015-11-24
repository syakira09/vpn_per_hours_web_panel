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
        $zones = array('usa','germany','singapore','uk','amsterdam','canada');
        foreach ($zones as $zone)
        {
            DB::table('zones')->insert(
                ['zonename' => $zone]
            );
        }
    }
}
