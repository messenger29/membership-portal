<?php

use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    		DB::table('teams')->insert([
        	'id' => 1,
        	'name' => 'DW',
        	'bio' => str_random(100),
        	'access_code' => str_random(10),
        	'type' => 'Org-Adult',
        	'email' => 'dw@test.org',
        	'location' => 'San Francisco, CA',
        	'year_established' => '2000',
        	'active' => 1,
        	'created_at' => '2014-01-01 00:00:00',
        	'updated_at' => '2017-01-01 00:00:00',
        ]);

        DB::table('teams')->insert([
        	'id' => 2,
        	'name' => 'ID',
        	'bio' => str_random(100),
        	'access_code' => str_random(10),
        	'type' => 'Org-Adult',
        	'email' => 'id@test.org',
        	'location' => 'Sacramento, CA',
        	'year_established' => '2014',
        	'active' => 1,
        	'created_at' => '2014-01-01 00:00:00',
        	'updated_at' => '2017-01-01 00:00:00',
        ]);

        DB::table('teams')->insert([
        	'id' => 3,
        	'name' => 'LDB',
        	'bio' => str_random(100),
        	'access_code' => str_random(10),
        	'type' => 'Org-Youth',
        	'email' => 'ldb@test.org',
        	'location' => 'San Francisco, CA',
        	'year_established' => '1998',
        	'active' => 1,
        	'created_at' => '2010-01-01 00:00:00',
        	'updated_at' => '2017-01-01 00:00:00',
        ]);

        DB::table('teams')->insert([
        	'id' => 4,
        	'name' => 'DRD',
        	'bio' => str_random(100),
        	'access_code' => str_random(10),
        	'type' => 'Org-College',
        	'email' => 'drd@test.org',
        	'location' => 'Davis, CA',
        	'year_established' => '2004',
        	'active' => 1,
        	'created_at' => '2010-01-01 00:00:00',
        	'updated_at' => '2017-01-01 00:00:00',
        ]);


    }
}
