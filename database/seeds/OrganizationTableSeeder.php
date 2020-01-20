<?php

use Illuminate\Database\Seeder;

class OrganizationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = App\User::all();
        foreach($users as $user) {
            if ($user->owned_orgs->count() == 0)
            {
                $user->owned_orgs()->save(factory(App\Organization::class)->make());
            }
        }
        
    }
}
