<?php

namespace App\Imports;

use App\Models\Material;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportMaterial implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
        $code = $row[0];
        $name = $row[1];
        $brand = $row[2];
        $uom = $row[3];
        $des = $row[4];

        $categoryData = Category::where('material_category',$code)->first(); 
  
        if(Material::exists()){
             $validate=Material::select('item_code')->where('item_code','LIKE','%'.$code.'%')->orderBy('id', 'DESC')->first();

             if(!empty($validate)){
                $arr = explode($code, $validate->item_code);
                $itemcode = $code.'00'.++$arr[1];

                     $MaterialData = Material::create([
                        'category_id' => $categoryData->code,
                        'item_code' => $itemcode,
                        'name' => $row[1],
                        'brand' => $row[2],
                        'uom' => $row[3],
                        'information'=> $des,
                  ]);   
             }
             else {

                $itemcode = $categoryData->material_category ."001";

                     $MaterialData = Material::create([
                        'category_id' => $categoryData->code,
                        'item_code' => $itemcode,
                        'name' => $row[1],
                        'brand' => $row[2],
                        'uom' => $row[3],
                        'information'=> $des,
                  ]);

             }

        }

        else {

            $itemcode = $code ."001";
        

                     $MaterialData = Material::create([
                        'category_id' => $categoryData->code,
                        'item_code' => $itemcode,
                        'name' => $row[1],
                        'brand' => $row[2],
                        'uom' => $row[3],
                        'information'=> $des,
                  ]);

        }



        return ; 
    }
}
