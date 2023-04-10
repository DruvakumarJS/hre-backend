<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

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

         $admin =
            [
                [
                    'name' => 'SuperAdmin',
                    'email' =>'admin@admin.com',
                    'role_id' => '1',
                    'role' => 'admin',
                    'password' => Hash::make('admin')
                ],
                
            
            ];

             foreach ($admin as $key => $value) {
            $role = User::create($value);
       }
            
    }
}
