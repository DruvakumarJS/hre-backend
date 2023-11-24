<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamSeeder extends Seeder
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
                        'team' => 'Super Admin',
                        'responsibilty' => 'All controles'
                    ],
                    [
                        'team' => 'Admin',
                        'responsibilty' => 'All controles '
                    ],
                    [
                        'team' => 'Project Team',
                        'responsibilty' => 'Controles related to projects'
                    ],
                    [
                        'team' => 'Finance & HR Team',
                        'responsibilty' => 'Controles related to accounts and attendance'
                    ],
                    [
                        'team' => 'Procurement Team',
                        'responsibilty' => 'Controles related to indents and GRN'
                    ],
                    
                    
                 ];

        foreach ($input as $key => $value) {
            $role = Team::create($value);
       }
    }
}
