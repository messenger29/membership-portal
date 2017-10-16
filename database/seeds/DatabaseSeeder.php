<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(UsersTableSeeder::class);
    	$this->call(ProfilesTableSeeder::class);
        $this->call(WaivertextTableSeeder::class);
        $this->call(WaiversTableSeeder::class);
        $this->call(MembershipTypesTableSeeder::class);
        $this->call(MembershipsTableSeeder::class);
        $this->call(TeamsTableSeeder::class);
        $this->call(TeamUserTableSeeder::class);
        $this->call(TeamManagersTableSeeder::class);

        // Race Events and Registrations
        $this->call(RaceEventsTableSeeder::class);
    }
}
