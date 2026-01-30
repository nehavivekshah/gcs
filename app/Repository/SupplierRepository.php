<?php 

namespace App\Repository;

use App\Models\Supplier;

class SupplierRepository{

    
    function getAllData(){
        return Supplier::select('suppliers.*','S.state as state_name','C.city as city_name','A.area as area_name')
        ->leftjoin('states as S','S.id','=','suppliers.state_id')
        ->leftjoin('cities as C','C.id','=','suppliers.city_id')
        ->leftjoin('areas as A','A.id','=','suppliers.area_id')
        ->get();
    }

    function createData($data){
        return Supplier::create($data);
    }

    function getDataById($uuid){
        return Supplier::where('uuid',$uuid)->first();
    }

    function updateData($uuid,$data){
        return Supplier::where('uuid',$uuid)->update($data);
    }

    function deleteData($uuid){
        return Supplier::where('uuid',$uuid)->delete();
    }

}

?>