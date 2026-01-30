<?php 

namespace App\Repository;

use App\Models\ProductType;

class ProductTypeRepository{

    
    function getAllData(){
        return ProductType::all();
    }

    function createData($data){
        return ProductType::create($data);
    }

    function getDataById($uuid){
        return ProductType::where('uuid',$uuid)->first();
    }

    function updateData($uuid,$data){
        return ProductType::where('uuid',$uuid)->update($data);
    }

    function deleteData($uuid){
        return ProductType::where('uuid',$uuid)->delete();
    }

}

?>