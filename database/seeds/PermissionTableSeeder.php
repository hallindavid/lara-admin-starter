<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $p1 = new Permission;
        $p1->title = "Test Permission";
        $p1->description = "Here is a test permission we can use to make sure permissions work correctly";
        $p1->save();

        $p2 = new Permission;
        $p2->title = "Test Permission 2";
        $p2->description = "Here is a test permission we can use to make sure permissions work correctly";
        $p2->save();

    }
}
