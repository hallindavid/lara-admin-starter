<?php

use Illuminate\Database\Seeder;
use App\UserPermission;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $u1 = new User;
        $u1->first_name = "John";
        $u1->last_name = "Doe";
        $u1->email = "jdoe@example.com";
        $u1->password = Hash::make('password');
        $u1->api_token = Str::random(80);
        $u1->is_admin = true;
        $u1->save();

        $u1->user_permissions()->save(new UserPermission(['permission_id'=>1]));
        $u1->user_permissions()->save(new UserPermission(['permission_id'=>2]));
    }
}
