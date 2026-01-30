<?php

namespace App\Services;

use App\Repository\YearRepository;

class YearService{

   function __construct(protected YearRepository $yearRepository){} 
   
   public function index(){
      return $this->yearRepository->getAllData();
    }

    public function store($data){
       return $this->yearRepository->createData($data);
    }

    public function edit($uuid){
       return $this->yearRepository->getDataById($uuid);
    }

    public function update($uuid, $updateData){
       return $this->yearRepository->updateData($uuid, $updateData);
    }

    public function destroy($uuid){
        return $this->yearRepository->deleteData($uuid);
    }


}