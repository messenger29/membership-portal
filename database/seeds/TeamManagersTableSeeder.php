<?php

use Illuminate\Database\Seeder;

class TeamManagersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('team_managers')->insert([
        	'user_id' => 1,
        	'team_id' => 2,
        	'primary' => 1,
        	'role' => 'Coach',
        	'active' => 1
        ]);

        DB::table('team_managers')->insert([
        	'user_id' => 1,
        	'team_id' => 4,
        	'primary' => 0,
        	'role' => 'Captain',
        	'active' => 1
        ]);
    }
}
