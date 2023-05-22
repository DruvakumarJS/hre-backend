<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Employee;
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
            $user = User::create($value);
       }

           $Employees = 
           [
            [
                'user_id' => '1',
                'employee_id' => "ADMIN001" , 
                'name' => "Super Admin" ,
                'mobile' => '9517531472',
                'email' => 'admin@admin.com',
                'role' => 'admin',
    
            ]
                   
           ];

           foreach ($Employees as $key => $value) {
               $emp = Employee::create($value);
           }
            
    }
}
