<?php 

namespace App\Repository;

use App\Models\Manufacture;

class ManufactureRepository{

    
    function getAllData(){
        return Manufacture::all();
    }

    function createData($data){
        return Manufacture::create($data);
    }

    function getDataById($uuid){
        return Manufacture::where('uuid',$uuid)->first();
    }

    function updateData($uuid,$data){
        return Manufacture::where('uuid',$uuid)->update($data);
    }

    function deleteData($uuid){
        return Manufacture::where('uuid',$uuid)->delete();
    }

}

?>