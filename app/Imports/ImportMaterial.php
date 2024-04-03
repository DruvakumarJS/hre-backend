<?php

namespace App\Imports;

use App\Models\Material;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;



class ImportMaterial implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public $rowCount = 0;

    public function startRow(): int
    {
        return 2;
    }

     public function model(array $row)
    {
        ++$this->rowCount;
        
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

        $keyarray=array();
        $valuearray=array();

        if($key1 != ""){
         array_push($keyarray , $key1);
         array_push($valuearray , $value1);
        }

         if($key2 != ""){
         array_push($keyarray , $key2);
         array_push($valuearray , $value2);
        }
         if($key3 != ""){
         array_push($keyarray , $key3);
         array_push($valuearray , $value3);
        }
        if($key4 != ""){
         array_push($keyarray , $key4);
         array_push($valuearray , $value4);
        }
         if($key5 != ""){
         array_push($keyarray , $key5);
         array_push($valuearray , $value5);
        }
         if($key6 != ""){
         array_push($keyarray , $key6);
         array_push($valuearray , $value6);
        }
         if($key7 != ""){
         array_push($keyarray , $key7);
         array_push($valuearray , $value7);
        }
         if($key8 != ""){
         array_push($keyarray , $key8);
         array_push($valuearray , $value8);
        }


        foreach ($keyarray as $key=>$value) {
          $result[$value]=$valuearray[$key];
        }

         /*print_r($result);print_r('<br>');
    
         print_r(json_encode($result));
          die();*/

         if(sizeof($result)>0){
             $features = json_encode($result,JSON_UNESCAPED_UNICODE);
         }
         else{
             $features = "{}";
         }
        
        if(Material::exists()){
             $validate=Material::select('item_code')->where('item_code','LIKE','%'.$code.'%')->orderBy('id', 'DESC')->first();

             if(!empty($validate)){
                $arr = explode($code, $validate->item_code);
                $itemcode = $code.'00'.++$arr[1];

                if(Material::where('category_id',$categoryData->code)
                           ->where('name' , $row[1])
                           ->where('brand' , $row[2])
                           ->where('uom', $row[3])
                           ->where('information' , $features)
                           ->exists()){
                    $this->rowCount--;
                 }
                else{
                     $MaterialData = Material::create([
                        'category_id' => $categoryData->code,
                        'item_code' => $itemcode,
                        'name' => $row[1],
                        'brand' => $row[2],
                        'uom' => $row[3],
                        'information'=> $features,
                  ]); 
                }

                      
             }
             else {

                $itemcode = $categoryData->material_category ."001";

                if(Material::where('category_id',$categoryData->code)
                           ->where('item_code' , $itemcode)
                           ->where('name' , $row[1])
                           ->where('brand' , $row[2])
                           ->where('uom', $row[3])
                           ->where('information' , $features)
                           ->exists()){
                    $this->rowCount--;
                 }
                else{

                     $MaterialData = Material::create([
                        'category_id' => $categoryData->code,
                        'item_code' => $itemcode,
                        'name' => $row[1],
                        'brand' => $row[2],
                        'uom' => $row[3],
                        'information'=> $features,
                  ]);
                 }

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
                        'information'=> $features,
                  ]);

        }

        

        return ; 
    }
  

    public function getRowCount(): int
    {
        return $this->rowCount;
    }


}
