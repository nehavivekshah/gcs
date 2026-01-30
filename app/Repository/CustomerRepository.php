<?php 

namespace App\Repository;

use App\Models\Customer;

class CustomerRepository{

    
    function getAllData(){
        return Customer::select('customers.*','S.state as state_name','C.city as city_name','A.area as area_name')
        ->leftJoin('states as S','S.id','=','customers.state_id')
        ->leftJoin('cities as C','C.id','=','customers.city_id')
        ->leftJoin('areas as A','A.id','=','customers.area_id')
        ->get();
    }

    function createData($data){
        return Customer::create($data);
    }

    function getDataById($uuid){
        return Customer::where('uuid',$uuid)->first();
    }

    function updateData($uuid,$data){
        return Customer::where('uuid',$uuid)->update($data);
    }

    function deleteData($uuid){
        return Customer::where('uuid',$uuid)->delete();
    }

}

?>