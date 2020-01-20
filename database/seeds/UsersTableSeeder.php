<?php
//Models
use App\Organization;
use App\User;

//Facades
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        $u1->first_name = "Admin";
        $u1->last_name = "Istrator";
        $u1->timezone = "America/Toronto";
        $u1->state = "ON";
        $u1->country = "Canada";
        $u1->email = "admin@admin.com";
        $u1->password = Hash::make('password');
        $u1->email_verified_at = Carbon::now()->toDateTimeString();
        $u1->api_token = Str::random(80);
        $u1->is_admin = true;
        $u1->save();

        $org1 = new Organization(['name'=>'Test Org']);
        $u1->owned_orgs()->save($org1);
        $u1 = $u1->fresh();
        

        $u2 = new User;
        $u2->first_name = "Test";
        $u2->last_name = "User";
        $u2->timezone = "America/Toronto";
        $u2->state = "ON";
        $u2->country = "Canada";
        $u2->email = "test@user.com";
        $u2->password = Hash::make('password');
        $u2->email_verified_at = Carbon::now()->toDateTimeString();
        $u2->api_token = Str::random(80);
        $u2->is_admin = false;
        $u2->save();

        $u2->organizations()->attach($org1->id);


        //Adding Extra Users
        factory(App\User::class, 5)->create();
    }
}
