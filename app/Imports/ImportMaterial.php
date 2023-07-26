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
        $key1 = $row[4];
        $value1 = $row[5];
        $key2 = $row[6];
        $value2 = $row[7];
        $key3 = $row[8];
        $value3 = $row[9];
        $key4 = $row[10];
        $value4 = $row[11];
        $key5 = $row[12];
        $value5 = $row[13];
        $key6 = $row[14];
        $value6 = $row[15];
        $key7 = $row[16];
        $value7 = $row[17];
        $key8 = $row[18];
        $value8 = $row[19];

        $categoryData = Category::where('material_category',$code)->first(); 

        $paramarray=array();

        if($key1 != ""){
          $param1=$key1.":".$value1;
         array_push($paramarray , $param1);
        }

        if($key2 != ""){
          $param2=$key2.":".$value2;
         array_push($paramarray , $param2);
        }

        if($key3 != ""){
          $param3=$key3.":".$value3;
          array_push($paramarray , $param3);
        }

        if($key4 != ""){
          $param4=$key4.":".$value4;
          array_push($paramarray , $param4);
        }

        if($key5 != ""){
          $param5=$key5.":".$value5;
          array_push($paramarray , $param5);
        }

        if($key6 != ""){
            $param6=$key6.":".$value6;
           array_push($paramarray , $param6);
          }

        if($key7 != ""){
            $param7=$key7.":".$value7;
            array_push($paramarray , $param7);
          }  
  
        if($key8 != ""){
          $param8=$key8.":".$value8;
          array_push($paramarray , $param8);
        }  


        print_r(json_encode($paramarray)); die();
        
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
   /* public function model(array $row)
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
    }*/


}
