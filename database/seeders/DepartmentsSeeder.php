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
                        
                    ],
                    [
                        'department' => 'Plumbing',
                        
                    ],
                    [
                        'department' => 'Civil',
                       
                    ],
                    [
                        'department' => 'IT',
                        
                    ],
                    [
                        'department' => 'HVAC',
                        
                    ],
                    [
                        'department' => 'Accounts',
                        
                    ],
                    [
                        'department' => 'HR',
                        
                    ]
                 ];
        foreach ($input as $key => $value) {
            $role = TicketDepartment::create($value);
       }
        //$admin = Role::create($input);
    }
}
