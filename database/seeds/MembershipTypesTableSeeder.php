<?php

use Illuminate\Database\Seeder;

class MembershipTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('membership_types')->insert([
        	'id' => 1,
        	'year' => '2017',
        	'name' => 'Adult',
        	'amount' => '140'
        ]);
        DB::table('membership_types')->insert([
        	'id' => 2,
        	'year' => '2017',
        	'name' => 'College',
        	'amount' => '70'
        ]);
        DB::table('membership_types')->insert([
        	'id' => 3,
        	'year' => '2017',
        	'name' => 'Youth',
        	'amount' => '0'
        ]);
    }
}
