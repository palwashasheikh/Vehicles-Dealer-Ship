<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = \DB::table('users')->where('email','info.mrgaragedoors@gmail.com')->get();
        if(count($user) == 0)
        {
            //admin
            $admin = User::create([
                'first_name' => 'System',
                'last_name' => 'Admin',
                'email' => 'info.mrgaragedoors@gmail.com',
                'password' => Hash::make('w3.MrsGarageDoor@MrRotemSinai'),
                'user_type' => 'admin',
            ]);
            $admin->assignRole('admin');
        }
    }
}
