<?php

namespace App\Services;

use App\Repository\EngineerRepository;

class EngineerService{

   function __construct(protected EngineerRepository $engineerRepository){} 
   
   public function index(){
      return $this->engineerRepository->getAllData();
    }

    public function store($data){
       return $this->engineerRepository->createData($data);
    }

    public function edit($uuid){
       return $this->engineerRepository->getDataById($uuid);
    }

    public function update($uuid, $updateData){
       return $this->engineerRepository->updateData($uuid, $updateData);
    }

    public function destroy($uuid){
        return $this->engineerRepository->deleteData($uuid);
    }


}