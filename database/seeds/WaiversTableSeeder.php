<?php

use Illuminate\Database\Seeder;

class WaiversTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('waivers')->insert([
        	'user_id' => '1',
        	'waivertext_id' => '1',
        	'year' => '2016',
        	'youth_flag' => '0',
        	'youth_agree_flag' => '0',
        	'medical_notes' => '',
        	'agree_flag' => '1',
        	'signature' => 'John',
            'created_at' => '2016-01-05 00:00:00',
            'updated_at' => '2016-01-05 00:00:00',
        ]);

        DB::table('waivers')->insert([
        	'user_id' => '1',
        	'waivertext_id' => '2',
        	'year' => '2017',
        	'youth_flag' => '0',
        	'youth_agree_flag' => '0',
        	'medical_notes' => str_random(10),
        	'agree_flag' => '1',
        	'signature' => 'John',
            'created_at' => '2017-01-05 00:00:00',
            'updated_at' => '2017-01-05 00:00:00',
        ]);

        DB::table('waivers')->insert([
        	'user_id' => '2',
        	'waivertext_id' => '2',
        	'year' => '2017',
        	'youth_flag' => '0',
        	'youth_agree_flag' => '0',
        	'medical_notes' => str_random(20),
        	'agree_flag' => '0',
        	'signature' => 'Denise',
            'created_at' => '2017-01-05 00:00:00',
            'updated_at' => '2017-01-05 00:00:00',
        ]);

        DB::table('waivers')->insert([
            'user_id' => '3',
            'waivertext_id' => '1',
            'year' => '2016',
            'youth_flag' => '0',
            'youth_agree_flag' => '0',
            'medical_notes' => str_random(20),
            'agree_flag' => '0',
            'signature' => 'Jane',
            'created_at' => '2016-01-05 00:00:00',
            'updated_at' => '2016-01-05 00:00:00',
        ]);
    }
}
