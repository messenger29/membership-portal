<?php

use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('profiles')->insert([
    		'user_id' => '1',
    		'first_name' => 'John',
    		'middle_initial' => 'J',
    		'last_name' => 'Yu',
    		'street' => str_random(10),
    		'city' => str_random(10),
    		'state' => str_random(2),
    		'zip' => str_random(5),
    		'phone_primary' => str_random(10),
    		'phone_alt' => str_random(10),
    		'birthdate' => '1988-01-01',
    		'gender' => 'M',
    		'emerg_name' => str_random(10),
    		'emerg_relation' => str_random(10),
    		'emerg_phone_primary' => str_random(10),
            'created_at' => '2016-01-05 00:00:00',
            'updated_at' => '2017-01-05 00:00:00',
    	]);

    	DB::table('profiles')->insert([
    		'user_id' => '2',
    		'first_name' => 'Denise',
    		'last_name' => str_random(5),
    		'street' => str_random(10),
    		'city' => str_random(10),
    		'state' => str_random(2),
    		'zip' => str_random(5),
    		'phone_primary' => str_random(10),
    		'birthdate' => '1992-01-01',
    		'gender' => 'F',
    		'emerg_name' => str_random(10),
    		'emerg_relation' => str_random(10),
    		'emerg_phone_primary' => str_random(10),
            'created_at' => '2017-01-05 00:00:00',
            'updated_at' => '2017-01-05 00:00:00',
    	]);

    	DB::table('profiles')->insert([
    		'user_id' => '3',
    		'first_name' => 'Jane',
    		'last_name' => str_random(5),
    		'street' => str_random(10),
    		'city' => str_random(10),
    		'state' => str_random(2),
    		'zip' => str_random(5),
    		'phone_primary' => str_random(10),
    		'birthdate' => '2002-01-01',
    		'gender' => 'F',
    		'emerg_name' => str_random(10),
    		'emerg_relation' => str_random(10),
    		'emerg_phone_primary' => str_random(10),
            'created_at' => '2016-01-05 00:00:00',
            'updated_at' => '2016-01-05 00:00:00',
    	]);
    }
}
