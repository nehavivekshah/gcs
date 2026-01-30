<?php

namespace App\Services;

use App\Repository\ProductAccessoriesRepository;

class ProductAccessoriesService{

   function __construct(protected ProductAccessoriesRepository $productAccessoriesRepository){} 
   
   public function index(){
      return $this->productAccessoriesRepository->getAllData();
    }

    public function store($data){
       return $this->productAccessoriesRepository->createData($data);
    }

    public function edit($uuid){
       return $this->productAccessoriesRepository->getDataById($uuid);
    }

    public function update($uuid, $updateData){
       return $this->productAccessoriesRepository->updateData($uuid, $updateData);
    }

    public function destroy($uuid){
        return $this->productAccessoriesRepository->deleteData($uuid);
    }


}