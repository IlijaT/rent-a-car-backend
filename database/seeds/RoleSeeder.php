<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_customer = new Role();
        $role_customer->name = "Customer";
        $role_customer->save();

        $owner = new Role();
        $owner->name = "Owner";
        $owner->save();

        $admin = new Role();
        $admin->name = "Admin";
        $admin->save();

        $worker = new Role();
        $worker->name = "Worker";
        $worker->save();




        
    }
}
