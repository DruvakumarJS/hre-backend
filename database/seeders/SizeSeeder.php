<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SizeMaster;

class SizeSeeder extends Seeder
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
                        'size' => '1200mm x 2400mm',
                        'description'=>''
                    ],
                    [
                        'category_id' => 'CT',
                        'size' => '900mm x 2100mm',
                        'description'=>''
                    ],
                    [
                        'category_id' => 'FS',
                        'size' => '150 mm',
                        'description'=>''
                    ],
                    [
                       'category_id' => 'FS',
                       'size' => '200 mm',
                       'description'=>''
                    ],
                    [
                        'category_id' => 'FS',
                        'size' => '900mm x 1800mm',
                        'description'=>''
                    ],
                    [
                        'category_id' => 'FS',
                        'size' => '1000 mtr',
                        'description'=>''
                    ],
                    [
                        'category_id' => 'CA',
                        'size' => '75mm x 100mm x 225mm',
                        'description'=>''
                    ],
                    [
                       'category_id' => 'CA',
                       'size' => '100mm x 200mm x 400mm',
                       'description'=>''
                    ],
                    [
                        'category_id' => 'CA',
                        'size' => '150mm x 2000mm x 400mm',
                        'description'=>''
                    ],
                    [
                        'category_id' => 'CA',
                        'size' => '200mm x 200mm x 400mm',
                        'description'=>''
                    ],
                    [
                        'category_id' => 'CA',
                        'size' => '100m x 200mm x 600mm',
                        'description'=>''
                    ],
                    [
                        'category_id' => 'CA',
                        'size' => 'CFT',
                        'description'=>''
                    ],

                    [
                        'category_id' => 'EL',
                        'size' => '12 mm',
                        'description'=>''
                    ],
                    [
                       'category_id' => 'EL',
                       'size' => '20 mm',
                       'description'=>''
                    ],
                    [
                        'category_id' => 'EL',
                        'size' => '20 mm',
                        'description'=>''
                    ],
                    [
                        'category_id' => 'EL',
                        'size' => '12 mm',
                        'description'=>''
                    ],
                    [
                        'category_id' => 'EL',
                        'size' => '5 amps',
                        'description'=>''
                    ],
                    [
                        'category_id' => 'EL',
                        'size' => '32 amps',
                        'description'=>''
                    ]


                 ];
        foreach ($input as $key => $value) {
            $role = SizeMaster::create($value);
       }
        //$admin = Role::create($input);
    }
}
