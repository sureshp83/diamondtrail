<?php

use Illuminate\Database\Seeder;
use App\Role;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_employee = new Role();
        $role_employee->name = 'Buyer';
        $role_employee->description = 'A Buyer User';
        $role_employee->save();
        $role_manager = new Role();
        $role_manager->name = 'Seller';
        $role_manager->description = 'A Seller User';
        $role_manager->save();
  }
}
