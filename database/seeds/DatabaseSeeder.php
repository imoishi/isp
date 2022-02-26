<?php

use App\Models\District;
use App\Models\Division;
use App\Models\Upazila;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Category;
use App\Models\Setting;
use App\Models\Area;
use App\Models\Package;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        User::truncate();
        Role::truncate();
        Permission::truncate();
        Category::truncate();
        Setting::truncate();
        Division::truncate();
        District::truncate();
        Upazila::truncate();
        Package::truncate();
        Area::truncate();

        $this->call(SettingSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(DivisionSeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(UpazilaSeeder::class);

        //for Admin
        $admin = factory(User::class)->create([
            'first_name' => 'Admin',
            'last_name' => '',
            'email' => 'admin@mail.com',
            'phone' => '0123456789',
            'avatar' => 'default-profile.png',
            'is_admin' => 1,
            'password' => bcrypt(123456),
            'package_id' => null,
        ]);
        $admin->assignRoles(['admin', 'staff', 'accountant']);

        //for editor
        $editor = factory(User::class)->create([
            'first_name' => 'Staff',
            'last_name' => '',
            'email' => 'staff@mail.com',
            'password' => bcrypt(123456),
            'is_admin' => 0,
            'package_id' => null,
        ]);
        $editor->assignRole('staff');

        //for editor
        $author = factory(User::class)->create([
            'first_name' => 'Accountant',
            'last_name' => '',
            'email' => 'accountant@mail.com',
            'password' => bcrypt(123456),
            'is_admin' => 0,
            'package_id' => null,
        ]);
        $author->assignRole('accountant');

        factory(User::class, 10)->create();

        $permissions = Permission::all();
        $permissions->each(function ($permission) {
            $role_admin = Role::where('name', 'admin')->first();
            $role_admin->givePermissionTo($permission);
        });

        // Category
        factory(Category::class, 15)->create();

        // Package
        factory(Package::class, 5)->create();

        // Area
        factory(Area::class, 50)->create();

    }
}
