<?php 

namespace App\Repository;

use App\Models\ProductAccessories;

class ProductAccessoriesRepository{

    
    function getAllData(){
        return ProductAccessories::all();
    }

    function createData($data){
        return ProductAccessories::create($data);
    }

    function getDataById($uuid){
        return ProductAccessories::where('uuid',$uuid)->first();
    }

    function updateData($uuid,$data){
        return ProductAccessories::where('uuid',$uuid)->update($data);
    }

    function deleteData($uuid){
        return ProductAccessories::where('uuid',$uuid)->delete();
    }

}

?>