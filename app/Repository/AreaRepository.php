<?php 

namespace App\Repository;

use App\Models\Area;

class AreaRepository{
    
    function getAllData(){
        return Area::select('areas.id','areas.state_id','areas.city_id','areas.area','S.state','C.city','areas.uuid','areas.created_by','areas.modified_by')
        ->join('states as S','S.id','=','areas.state_id')
        ->join('cities as C','C.id','=','areas.city_id')
        ->get();
    }

    function createData($data){
        return Area::create($data);
    }

    function getDataById($uuid){
        return Area::where('uuid',$uuid)->first();
    }

    function updateData($uuid,$data){
        return Area::where('uuid',$uuid)->update($data);
    }

    function deleteData($uuid){
        return Area::where('uuid',$uuid)->delete();
    }

}

?>