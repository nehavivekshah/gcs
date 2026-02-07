<?php 

namespace App\Repository;

use App\Models\Coordinator;

class CoordinatorRepository{

    
    function getAllData(){
        return Coordinator::select('coordinators.*','UT.user_type as type')->join('user_types as UT','UT.id','=','coordinators.user_type')->get();
    }

    function createData($data){
        return Coordinator::create($data);
    }

    function getDataById($uuid){
        return Coordinator::where('uuid',$uuid)->first();
    }

    function updateData($uuid,$data){
        return Coordinator::where('uuid',$uuid)->update($data);
    }

    function deleteData($uuid){
        return Coordinator::where('uuid',$uuid)->delete();
    }

}

?>