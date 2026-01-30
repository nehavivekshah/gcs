<?php 

namespace App\Repository;

use App\Models\AmcProduct;

class AmcProductRepository{

    
    function getAllData(){
        return AmcProduct::all();
    }

    function createData($data){
        return AmcProduct::create($data);
    }

    function getDataById($uuid){
        return AmcProduct::where('uuid',$uuid)->first();
    }

    function updateData($uuid,$data){
        return AmcProduct::where('uuid',$uuid)->update($data);
    }

    function deleteData($uuid){
        return AmcProduct::where('uuid',$uuid)->delete();
    }

}

?>