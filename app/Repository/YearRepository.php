<?php 

namespace App\Repository;

use App\Models\FinancialYear;

class YearRepository{

    
    function getAllData(){
        return FinancialYear::all();
    }

    function createData($data){
        return FinancialYear::create($data);
    }

    function getDataById($uuid){
        return FinancialYear::where('uuid',$uuid)->first();
    }

    function updateData($uuid,$data){
        return FinancialYear::where('uuid',$uuid)->update($data);
    }

    function deleteData($uuid){
        return FinancialYear::where('uuid',$uuid)->delete();
    }

}

?>