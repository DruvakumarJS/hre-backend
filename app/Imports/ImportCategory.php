<?php

namespace App\Imports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportCategory implements ToModel, WithStartRow
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
         $categoryName = strtoupper($row[0]); ;
         $material_category = strtoupper($row[1]) ;
        
         $categoryDesc = $row[2] ;

         if(Category::exists()){
             $validate = Category::where('category',$categoryName)->get();

        if(sizeof($validate)>0){
            
         }
         else {

            $category_id=Category::select('code')->orderBy('id', 'DESC')->first();

            $arr = explode("C00", $category_id->code);

            $code = 'C00'.++$arr[1];

            $CreateCategory = Category::create(
                [
                    'code' => $code,
                    'category' => $categoryName,
                    'material_category' => $material_category,
                    'description' => $categoryDesc
                ]) ;
         }

        }
        else {
            $code = 'C001';

            $CreateCategory = Category::create(
                [
                    'code' => $code,
                    'category' => $categoryName,
                    'material_category' => $material_category,
                    'description' => $categoryDesc
                ]) ;
        }


        return ;
    }

     public function getRowCount(): int
    {
        return $this->rowCount;
    }

}
