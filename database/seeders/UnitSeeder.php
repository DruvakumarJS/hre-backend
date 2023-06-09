<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UnitMaster;

class UnitSeeder extends Seeder
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
                        'unit' => "Nos",
                        'description'=>''
                    ],
                    [
                        'category_id' => 'FS',
                        'unit' => "Nos",
                        'description'=>''
                    ],
                    [
                        'category_id' => 'FS',
                        'unit' => 'RMT (Running Meter)',
                        'description'=>''
                    ],
                    [
                        'category_id' => 'FS',
                        'unit' => 'CFT (Cubic Feet)',
                        'description'=>''
                    ],
                     [
                        'category_id' => 'EL',
                        'unit' => 'Length',
                        'description'=>''
                    ],
                     [
                        'category_id' => 'EL',
                        'unit' => "Nos",
                        'description'=>''
                    ]
                    

                 ];
        foreach ($input as $key => $value) {
            $role = UnitMaster::create($value);
       }
        //$admin = Role::create($input);
    }
}
