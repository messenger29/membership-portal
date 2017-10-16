<?php

use Illuminate\Database\Seeder;

class RaceEventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('race_events')->insert([
        	'name' => 'Regional Regatta',
        	'location' => 'San Francisco, CA',
        	'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe eligendi, itaque sint dolorum laudantium voluptates doloremque, obcaecati in, magni eaque architecto. Aspernatur maiores tenetur illo ut nesciunt laudantium impedit, repudiandae.',
        	'event_start_date' => '2017-05-01',
        	'event_end_date' => null,
        	'register_start_date' => '2017-03-01',
        	'register_end_date' => '2017-04-15',
        	'slots' => 24,
            'participants_max' => 26,
            'alternates_max' => 4,
        	'active' => 1,
        	'closed' => 0,
        ]);

        DB::table('race_events')->insert([
        	'name' => 'Sprint Race',
        	'location' => 'Redwood City, CA',
        	'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. In amet iure neque alias a laboriosam, autem fugiat suscipit deserunt, rerum expedita maxime recusandae asperiores saepe deleniti. Eum, eos eveniet quas.',
        	'event_start_date' => '2017-07-15',
        	'event_end_date' => null,
        	'register_start_date' => '2017-05-15',
        	'register_end_date' => '2017-07-01',
        	'slots' => 36,
            'participants_max' => 26,
            'alternates_max' => 4,
        	'active' => 1,
        	'closed' => 0,
        ]);

         DB::table('race_events')->insert([
        	'name' => 'Festival Race - Comp/Rec',
        	'location' => 'Oakland, CA',
        	'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. In amet iure neque alias a laboriosam, autem fugiat suscipit deserunt, rerum expedita maxime recusandae asperiores saepe deleniti. Eum, eos eveniet quas.',
        	'event_start_date' => '2017-11-04',
        	'event_end_date' => '2017-11-05',
        	'register_start_date' => '2017-10-01',
        	'register_end_date' => '2017-11-01',
        	'slots' => 30,
            'participants_max' => 26,
            'alternates_max' => 4,
        	'active' => 1,
        	'closed' => 0,
        ]);

         DB::table('race_events')->insert([
        	'name' => 'College Race',
        	'location' => 'San Francisco, CA',
        	'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. In amet iure neque alias a laboriosam, autem fugiat suscipit deserunt, rerum expedita maxime recusandae asperiores saepe deleniti. Eum, eos eveniet quas.',
        	'event_start_date' => '2017-11-18',
        	'event_end_date' => null,
        	'register_start_date' => '2017-10-15',
        	'register_end_date' => '2017-11-17',
        	'slots' => 24,
            'participants_max' => 26,
            'alternates_max' => 4,
        	'active' => 0,
        	'closed' => 0,
        ]);
    }
}
