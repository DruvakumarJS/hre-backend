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
                        'description'=>'All Controles',
                        'team_id'=> 1
                    ],
                     [
                        'name' => 'admin',
                        'alias' => 'Admin',
                        'description'=>'All controles',
                        'team_id'=> 2
                    ] ,
                    [
                        'name' => 'project_manager',
                        'alias' => 'Project Manager',
                        'description'=>'Can manage Tickets',
                        'team_id'=> 3
                    ],
                     [
                        'name' => 'asst_manager',
                        'alias' => 'Assistant Project Manager',
                        'description'=>'no controle',
                        'team_id'=> 3
                    ],
                     [
                        'name' => 'project_incharge',
                        'alias' => 'Project Incharge',
                        'description'=>'no controle',
                        'team_id'=> 3
                    ],
                    [
                        'name' => 'finance_manager',
                        'alias' => 'Finance Manager',
                        'description'=>'Responsible for Pettycash',
                        'team_id'=> 4
                    ] ,
                     [
                        'name' => 'sr_accountant',
                        'alias' => 'Sr Accountant',
                        'description'=>'no controle',
                        'team_id'=> 4
                    ],
                    [
                        'name' => 'jr_accountant',
                        'alias' => 'Jr Accountant',
                        'description'=>'no controle',
                        'team_id'=> 4
                    ],
                     [
                        'name' => 'hr',
                        'alias' => 'HR',
                        'description'=>'no controle',
                        'team_id'=> 4
                    ],

                    [
                        'name' => 'procurement_manager',
                        'alias' => 'Procurement Manager',
                        'description'=>'Dispatch Indents',
                        'team_id'=> 5
                    ],
                     [
                        'name' => 'sr_executive',
                        'alias' => 'Sr Executive',
                        'description'=>'no controle',
                        'team_id'=> 5
                    ],
                    [
                        'name' => 'jr_executive',
                        'alias' => 'Jr Executive',
                        'description'=>'no controle',
                        'team_id'=> 5
                    ],
                    
                    [
                        'name' => 'supervisor',
                        'alias' => 'Supervisor',
                        'description'=>'Create Indents',
                        'team_id'=> 3
                    ],
                    
                     [
                        'name' => 'trainee_supervisor',
                        'alias' => 'Trainee Supervisor',
                        'description'=>'no controle',
                        'team_id'=> 3
                    ]
                    
                 ];
        foreach ($input as $key => $value) {
            $role = Roles::create($value);
       }
        //$admin = Role::create($input);
    }
}
