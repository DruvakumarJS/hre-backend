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
                        'name' => 'Super Admin',
                        'description'=>'All Controles'
                    ],
                    [
                        'name' => 'Project Mangaer',
                        'description'=>'All Controles'
                    ],
                    [
                        'name' => 'Procurement',
                        'description'=>'Limited data can see'
                    ],
                    [
                        'name' => 'Supervisor',
                        'description'=>'Limited data can see'
                    ]
                 ];
        foreach ($input as $key => $value) {
            $role = Roles::create($value);
       }
        //$admin = Role::create($input);
    }
}
