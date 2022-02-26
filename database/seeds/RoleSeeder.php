<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Admin', 'slug' => 'admin', 'created_by' => 1, 'description' => 'Admin example Description']);
        Role::create(['name' => 'Staff', 'slug' => 'staff', 'created_by' => 1, 'description' => 'Staff example Description']);
        Role::create(['name' => 'Accountant', 'slug' => 'accountant', 'created_by' => 1, 'description' => 'Accountant example Description']);
    }
}
