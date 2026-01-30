<?php

namespace App\Services;

use App\Repository\AmcProductRepository;

class AmcProductService{

   function __construct(protected AmcProductRepository $amcProductRepository){} 
   
   public function index(){
      return $this->amcProductRepository->getAllData();
    }

    public function store($data){
       return $this->amcProductRepository->createData($data);
    }

    public function edit($uuid){
       return $this->amcProductRepository->getDataById($uuid);
    }

    public function update($uuid, $updateData){
       return $this->amcProductRepository->updateData($uuid, $updateData);
    }

    public function destroy($uuid){
        return $this->amcProductRepository->deleteData($uuid);
    }


}