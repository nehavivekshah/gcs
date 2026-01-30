<?php 

namespace App\Repository;

use App\Models\Product;

class ProductRepository{

    
    function getAllData(){

        return Product::select('products.*','MN.manufacture as manufacture_name','PT.product_type as product_type_name','PT.sub_product_type')
               ->join('manufactures as MN','MN.id','=', 'products.manufacture')
               ->join('product_types as PT','PT.id','=', 'products.product_type')
                ->get();
    }

    function createData($data){
        return Product::create($data);
    }

    function getDataById($uuid){
        return Product::where('uuid',$uuid)->first();
    }

    function updateData($uuid,$data){
        return Product::where('uuid',$uuid)->update($data);
    }

    function deleteData($uuid){
        return Product::where('uuid',$uuid)->delete();
    }

}

?>