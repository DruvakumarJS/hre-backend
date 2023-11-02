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
                        'name' => 'admin',
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
                        'name' => 'asst_manager',
                        'alias' => 'Assistant Project Manager',
                        'description'=>'no controle'
                    ],
                    [
                        'name' => 'exec_manager',
                        'alias' => 'Executive project Manager',
                        'description'=>'no controle'
                    ],
                    [
                        'name' => 'asst_procurement',
                        'alias' => 'Assistant Procurement Manager',
                        'description'=>'no controle'
                    ],
                    [
                        'name' => 'exec_procuement',
                        'alias' => 'Executive Procurement Manager',
                        'description'=>'no controle'
                    ],
                    [
                        'name' => 'asst_finance',
                        'alias' => 'Assistant Finance Manager',
                        'description'=>'no controle'
                    ],
                    [
                        'name' => 'jun_finance',
                        'alias' => 'Junior Finance Manager',
                        'description'=>'no controle'
                    ]
                 ];
        foreach ($input as $key => $value) {
            $role = Roles::create($value);
       }
        //$admin = Role::create($input);
    }
}
