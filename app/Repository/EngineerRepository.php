<?php 

namespace App\Repository;

use App\Models\Engineer;

class EngineerRepository{

    
    function getAllData(){
        return Engineer::all();
    }

    function createData($data){
        return Engineer::create($data);
    }

    function getDataById($uuid){
        return Engineer::where('uuid',$uuid)->first();
    }

    function updateData($uuid,$data){
        return Engineer::where('uuid',$uuid)->update($data);
    }

    function deleteData($uuid){
        return Engineer::where('uuid',$uuid)->delete();
    }

}

?>