<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'id' => 1,
        	'name' => 'John',
        	'email' => 'john@test.org',
        	'password' => bcrypt('secret')
        ]);

        DB::table('users')->insert([
        	'id' => 2,
        	'name' => 'Denise',
        	'email' => 'denise@test.org',
        	'password' => bcrypt('secret')
        ]);

        DB::table('users')->insert([
            'id' => 3,
            'name' => 'Jane',
            'email' => 'jane@test.org',
            'password' => bcrypt('secret')
        ]);

        DB::table('users')->insert([
            'id' => 4,
            'name' => 'Bob',
            'email' => 'bob@test.org',
            'password' => bcrypt('secret')
        ]);

        DB::table('users')->insert([
            'id' => 5,
            'name' => 'Jon',
            'email' => 'jon@test.org',
            'password' => bcrypt('secret')
        ]);

        DB::table('users')->insert([
            'id' => 6,
            'name' => 'Mitch',
            'email' => 'mitch@test.org',
            'password' => bcrypt('secret')
        ]);

        DB::table('users')->insert([
            'id' => 7,
            'name' => 'Tiff',
            'email' => 'tiff@test.org',
            'password' => bcrypt('secret')
        ]);

        DB::table('users')->insert([
            'id' => 8,
            'name' => 'Chris',
            'email' => 'chris@test.org',
            'password' => bcrypt('secret')
        ]);

        DB::table('users')->insert([
            'id' => 9,
            'name' => 'Pat',
            'email' => 'pat@test.org',
            'password' => bcrypt('secret')
        ]);

        DB::table('users')->insert([
            'id' => 10,
            'name' => 'Amy',
            'email' => 'amy@test.org',
            'password' => bcrypt('secret')
        ]);

        DB::table('users')->insert([
            'id' => 11,
            'name' => 'Mike',
            'email' => 'mike@test.org',
            'password' => bcrypt('secret')
        ]);
    }
}
