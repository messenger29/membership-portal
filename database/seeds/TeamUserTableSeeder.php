<?php

use Illuminate\Database\Seeder;

class TeamUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    		DB::table('team_user')->insert([
        	'user_id' => 1,
        	'team_id' => 1,
        	'active' => 0,
        ]);

        DB::table('team_user')->insert([
        	'user_id' => 1,
        	'team_id' => 2,
        	'active' => 1,
        	'request' => 0
        ]);

        DB::table('team_user')->insert([
        	'user_id' => 2,
        	'team_id' => 2,
        	'active' => 1,
        	'request' => 0
        ]);

        DB::table('team_user')->insert([
        	'user_id' => 3,
        	'team_id' => 2,
        	'active' => 0,
        	'request' => 1
        ]);

        DB::table('team_user')->insert([
            'user_id' => 5,
            'team_id' => 2,
            'active' => 1,
            'request' => 0
        ]);

        DB::table('team_user')->insert([
            'user_id' => 6,
            'team_id' => 2,
            'active' => 1,
            'request' => 0
        ]);

        DB::table('team_user')->insert([
            'user_id' => 7,
            'team_id' => 2,
            'active' => 1,
            'request' => 0
        ]);

        DB::table('team_user')->insert([
            'user_id' => 8,
            'team_id' => 2,
            'active' => 1,
            'request' => 0
        ]);

        DB::table('team_user')->insert([
            'user_id' => 9,
            'team_id' => 2,
            'active' => 1,
            'request' => 0
        ]);

        DB::table('team_user')->insert([
            'user_id' => 10,
            'team_id' => 2,
            'active' => 1,
            'request' => 0
        ]);

        DB::table('team_user')->insert([
            'user_id' => 11,
            'team_id' => 2,
            'active' => 1,
            'request' => 0
        ]);
    }
}
