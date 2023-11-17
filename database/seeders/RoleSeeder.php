<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Roles;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = [
                    [
                        'name' => 'superadmin',
                        'alias' => 'Super Admin',
                        'description'=>'All Controles'
                    ],
                    [
                        'name' => 'manager',
                        'alias' => 'Project Manager',
                        'description'=>'Can manage Tickets'
                    ],
                    [
                        'name' => 'procurement',
                        'alias' => 'Procurement',
                        'description'=>'Dispatch Indents'
                    ],
                    [
                        'name' => 'supervisor',
                        'alias' => 'Supervisor',
                        'description'=>'Create Indents'
                    ],
                    [
                        'name' => 'finance',
                        'alias' => 'Finance Manager',
                        'description'=>'Responsible for Pettycash'
                    ] ,
                    [
                        'name' => 'admin',
                        'alias' => 'Admin',
                        'description'=>'All controles'
                    ] ,

                    [
                        'name' => 'exec_manager',
                        'alias' => 'Executive Project Manager',
                        'description'=>'no controle'
                    ],
                     [
                        'name' => 'exec_procuement',
                        'alias' => 'Executive Procurement Manager',
                        'description'=>'no controle'
                    ],
                     [
                        'name' => 'trainee',
                        'alias' => 'Supervisor-Trainee',
                        'description'=>'no controle'
                    ],
                     [
                        'name' => 'accounts_manager',
                        'alias' => 'Accounts manager',
                        'description'=>'no controle'
                    ],

                    [
                        'name' => 'assist_manager',
                        'alias' => 'Assistant project Manager',
                        'description'=>'no controle'
                    ],
                    [
                        'name' => 'assist_procurement',
                        'alias' => 'Assistant Procurement',
                        'description'=>'no controle'
                    ],
                    [
                        'name' => 'accountant',
                        'alias' => 'Accountant',
                        'description'=>'no controle'
                    ],
                   
                    [
                        'name' => 'hr_manager',
                        'alias' => 'HR Manager',
                        'description'=>'no controle'
                    ],
                    [
                        'name' => 'hr_executive',
                        'alias' => 'HR Executive',
                        'description'=>'no controle'
                    ]
                 ];
        foreach ($input as $key => $value) {
            $role = Roles::create($value);
       }
        //$admin = Role::create($input);
    }
}
