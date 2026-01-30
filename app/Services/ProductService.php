<?php

namespace App\Services;

use App\Repository\ProductRepository;
Use App\Models\Manufacture;
use App\Models\ProductType;

class ProductService{

   function __construct(protected ProductRepository $productRepository){} 
   
   public function index(){
      return $this->productRepository->getAllData();
    }

    public function store($data){
       return $this->productRepository->createData($data);
    }

    public function edit($uuid){
       return $this->productRepository->getDataById($uuid);
    }

    public function update($uuid, $updateData){
       return $this->productRepository->updateData($uuid, $updateData);
    }

    public function destroy($uuid){
        return $this->productRepository->deleteData($uuid);
    }

    public function getManufacture(){
      return Manufacture::select('id','uuid','manufacture')->get();
    }

    public function getProductType(){
      return ProductType::select('id','uuid','product_type')->get();
    }

    public function addManufacture($data){
      return Manufacture::create($data);
    }

    public function addProductType($data){
      return ProductType::create($data);
    }

    public function getSubProductType($id){
      return ProductType::select('id','uuid','sub_product_type')->where('id', $id)->get();
    } 

}