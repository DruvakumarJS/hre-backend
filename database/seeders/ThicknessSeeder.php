<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ThicknessMaster;

class ThicknessSeeder extends Seeder
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
                        'category_id' => 'CT',
                        'thickness' => 'mm',
                        'description'=>''
                    ],
                    [
                        'category_id' => 'FS',
                        'thickness' => 'mm',
                        'description'=>''
                    ],
                    [
                        'category_id' => 'FS',
                        'thickness' => 'mm Density',
                        'description'=>''
                    ],
                    [
                        'category_id' => 'EL',
                        'thickness' => 'Gauge',
                        'description'=>''
                    ],
                    [
                        'category_id' => 'EL',
                        'thickness' => 'n/a',
                        'description'=>''
                    ]

                 ];
        foreach ($input as $key => $value) {
            $role = ThicknessMaster::create($value);
       }
        //$admin = Role::create($input);
    }
}
