<?php

use Illuminate\Database\Seeder;

class MembershipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    		DB::table('memberships')->insert([
	        	'user_id' => '1',
	        	'waiver_id' => '1',
	        	'profile_id' => '1',
	        	'membership_type_id' => '2',
	        	'year' => 2016,
	        	'active' => 1,
	        	'paid' => 1,
	          'created_at' => '2016-01-05 00:00:00',
	          'updated_at' => '2016-01-05 00:00:00',
        ]);

       DB::table('memberships')->insert([
	        	'user_id' => '1',
	        	'waiver_id' => '2',
	        	'profile_id' => '1',
	        	'membership_type_id' => '1',
	        	'year' => 2017,
	        	'active' => 1,
	        	'paid' => 1,
	          'created_at' => '2017-01-05 00:00:00',
	          'updated_at' => '2017-01-05 00:00:00',
	      ]);
    }
}
