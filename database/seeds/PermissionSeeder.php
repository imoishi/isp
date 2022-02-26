<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //user permissions
        Permission::create(['name' => 'Access User', 'slug' => 'access-user', 'for' => 'user']);
        Permission::create(['name' => 'Create User', 'slug' => 'create-user', 'for' => 'user']);
        Permission::create(['name' => 'Update User', 'slug' => 'update-user', 'for' => 'user']);
        Permission::create(['name' => 'Show User', 'slug' => 'show-user', 'for' => 'user']);
        Permission::create(['name' => 'Delete User', 'slug' => 'delete-user', 'for' => 'user']);
        Permission::create(['name' => 'Status Change User', 'slug' => 'status-change-user', 'for' => 'user']);

        // Role permissions
        Permission::create(['name' => 'Access Role', 'slug' => 'access-role', 'for' => 'role']);
        Permission::create(['name' => 'Create Role', 'slug' => 'create-role', 'for' => 'role']);
        Permission::create(['name' => 'Update Role', 'slug' => 'update-role', 'for' => 'role']);
        Permission::create(['name' => 'Show Role', 'slug' => 'show-role', 'for' => 'role']);
        Permission::create(['name' => 'Delete Role', 'slug' => 'delete-role', 'for' => 'role']);

        // Expense permissions
        Permission::create(['name' => 'Access Expense', 'slug' => 'access-expense', 'for' => 'expense']);
        Permission::create(['name' => 'Create Expense', 'slug' => 'create-expense', 'for' => 'expense']);
        Permission::create(['name' => 'Update Expense', 'slug' => 'update-expense', 'for' => 'expense']);
        Permission::create(['name' => 'Show Expense', 'slug' => 'show-expense', 'for' => 'expense']);
        Permission::create(['name' => 'Delete Expense', 'slug' => 'delete-expense', 'for' => 'expense']);

        // Package permissions
        Permission::create(['name' => 'Access Package', 'slug' => 'access-package', 'for' => 'package']);
        Permission::create(['name' => 'Create Package', 'slug' => 'create-package', 'for' => 'package']);
        Permission::create(['name' => 'Update Package', 'slug' => 'update-package', 'for' => 'package']);
        Permission::create(['name' => 'Show Package', 'slug' => 'show-package', 'for' => 'package']);
        Permission::create(['name' => 'Delete Package', 'slug' => 'delete-package', 'for' => 'package']);
        Permission::create(['name' => 'Status Change User', 'slug' => 'status-change-package', 'for' => 'package']);

        // Customer permissions
        Permission::create(['name' => 'Access Customer', 'slug' => 'access-customer', 'for' => 'customer']);
        Permission::create(['name' => 'Create Customer', 'slug' => 'create-customer', 'for' => 'customer']);
        Permission::create(['name' => 'Update Customer', 'slug' => 'update-customer', 'for' => 'customer']);
        Permission::create(['name' => 'Show Customer', 'slug' => 'show-customer', 'for' => 'customer']);
        Permission::create(['name' => 'Delete Customer', 'slug' => 'delete-customer', 'for' => 'customer']);
        Permission::create(['name' => 'Status Change User', 'slug' => 'status-change-customer', 'for' => 'customer']);

        // Bill permissions
        Permission::create(['name' => 'Access Bill', 'slug' => 'access-bill', 'for' => 'bill']);
        Permission::create(['name' => 'Create Bill', 'slug' => 'create-bill', 'for' => 'bill']);
        Permission::create(['name' => 'Update Bill', 'slug' => 'update-bill', 'for' => 'bill']);
        Permission::create(['name' => 'Show Bill', 'slug' => 'show-bill', 'for' => 'bill']);
        Permission::create(['name' => 'Delete Bill', 'slug' => 'delete-bill', 'for' => 'bill']);

        //other permissions
        Permission::create(['name' => 'Access Setting', 'slug' => 'access-setting', 'for' => 'other']);
        Permission::create(['name' => 'Access Category', 'slug' => 'access-category', 'for' => 'other']);
        Permission::create(['name' => 'Access Expense Type', 'slug' => 'access-expense-type', 'for' => 'other']);
        Permission::create(['name' => 'Access Report', 'slug' => 'access-report', 'for' => 'other']);
        Permission::create(['name' => 'Access Area', 'slug' => 'access-area', 'for' => 'other']);
        Permission::create(['name' => 'Access Slider', 'slug' => 'access-slider', 'for' => 'other']);
    }
}
