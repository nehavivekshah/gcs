<?php 

namespace App\Repository;

use App\Models\Cities;

class CityRepository{

    
    function getAllData(){
        return Cities::select('cities.id','cities.uuid','cities.state_id','cities.city','cities.created_by','cities.modified_by','S.state')
        ->join('states as S','S.id','=','cities.state_id')
        ->get();
    }

    function createData($data){
        return Cities::create($data);
    }

    function getDataById($uuid){
        return Cities::where('uuid',$uuid)->first();
    }

    function updateData($uuid,$data){
        return Cities::where('uuid',$uuid)->update($data);
    }

    function deleteData($uuid){
        return Cities::where('uuid',$uuid)->delete();
    }

}

?>