<?php

namespace Database\Seeders;

use App\Models\Role;
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
        $roles = new Role();
        $roles->id = "1";
        $roles->name = "Admin";
        $roles->created_at = now();
        $roles->updated_at = now();
        $roles->save();

        $roles = new Role();
        $roles->id = "2";
        $roles->name = "Staff";
        $roles->created_at = now();
        $roles->updated_at = now();
        $roles->save();
    }
}
// php artisan db:seed --class=RoleSeeder