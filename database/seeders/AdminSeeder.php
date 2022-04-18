<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = new User();
        $users->id = "1";
        $users->role_id = "1";
        $users->first_name = "G70";
        $users->last_name = "Admin";
        $users->email = "Admin@gmail.com";
        $users->password = Hash::make('123456');
        $users->created_at = now();
        $users->updated_at = now();
        $users->save();
    }
}
// php artisan db:seed --class=AdminSeeder
