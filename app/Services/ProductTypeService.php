<?php

namespace App\Services;

use App\Repository\ProductTypeRepository;

class ProductTypeService{

   function __construct(protected ProductTypeRepository $productTypeRepository){} 
   
   public function index(){
      return $this->productTypeRepository->getAllData();
    }

    public function store($data){
       return $this->productTypeRepository->createData($data);
    }

    public function edit($uuid){
       return $this->productTypeRepository->getDataById($uuid);
    }

    public function update($uuid, $updateData){
       return $this->productTypeRepository->updateData($uuid, $updateData);
    }

    public function destroy($uuid){
        return $this->productTypeRepository->deleteData($uuid);
    }


}