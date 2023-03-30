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
                
                [
                    'name' => 'Druva Kumar JS',
                    'email' =>'druva@netiapps.com',
                    'role_id' => '1',
                    'role' => 'admin',
                    'password' => Hash::make('druva')
                ],

                 [
                    'name' => 'Druva Kumar JS',
                    'email' =>'manager@netiapps.com',
                    'role_id' => '2',
                    'role' => 'manager',
                    'password' => Hash::make('druva')
                ],
                 [
                    'name' => 'Druva Kumar JS',
                    'email' =>'procurement@netiapps.com',
                    'role_id' => '3',
                    'role' => 'procurement',
                    'password' => Hash::make('druva')
                ],

                 [
                    'name' => 'Druva Kumar JS',
                    'email' =>'supervisor@netiapps.com',
                    'role_id' => '4',
                    'role' => 'supervisor',
                    'password' => Hash::make('druva')
                ]

            ];

             foreach ($admin as $key => $value) {
            $role = User::create($value);
       }
            
    }
}
