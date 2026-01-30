<?php 

namespace App\Repository;

use App\Models\States;

class StateRepository{

    
    function getAllData(){
        return States::all();
    }

    function createData($data){
        return States::create($data);
    }

    function getDataById($uuid){
        return States::where('uuid',$uuid)->first();
    }

    function updateData($uuid,$data){
        return States::where('uuid',$uuid)->update($data);
    }

    function deleteData($uuid){
        return States::where('uuid',$uuid)->delete();
    }

}

?>