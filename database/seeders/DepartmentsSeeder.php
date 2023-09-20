<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TicketDepartment;

class DepartmentsSeeder extends Seeder
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
                        'department' => 'Carpentry',
                        'roles' => '1,2',
                        
                    ],
                    [
                        'department' => 'Plumbing',
                        'roles' => '1,2',
                        
                    ],
                    [
                        'department' => 'Civil',
                        'roles' => '1,2',
                       
                    ],
                    [
                        'department' => 'IT',
                        'roles' => '1,2',
                        
                    ],
                    [
                        'department' => 'HVAC',
                        'roles' => '1,2',
                        
                    ],
                    [
                        'department' => 'Accounts',
                        'roles' => '1,2,5',
                        
                    ],
                    [
                        'department' => 'HR',
                        'roles' => '1,2',
                        
                    ]
                 ];
        foreach ($input as $key => $value) {
            $role = TicketDepartment::create($value);
       }
        //$admin = Role::create($input);
    }
}
