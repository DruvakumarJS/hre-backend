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
                        'description'=>'All Controles'
                    ],
                    [
                        'name' => 'procurement',
                        'alias' => 'Procurement',
                        'description'=>'Limited data can see'
                    ],
                    [
                        'name' => 'supervisor',
                        'alias' => 'Supervisor',
                        'description'=>'Limited data can see'
                    ],
                    [
                        'name' => 'finance',
                        'alias' => 'Finance',
                        'description'=>'Limited data can see'
                    ]
                 ];
        foreach ($input as $key => $value) {
            $role = Roles::create($value);
       }
        //$admin = Role::create($input);
    }
}
