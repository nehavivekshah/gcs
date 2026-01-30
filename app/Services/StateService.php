<?php

namespace App\Services;

use App\Repository\StateRepository;

class StateService{

   function __construct(protected StateRepository $stateRepository){} 
   
   public function index(){
      return $this->stateRepository->getAllData();
    }

    public function store($data){
       return $this->stateRepository->createData($data);
    }

    public function edit($uuid){
       return $this->stateRepository->getDataById($uuid);
    }

    public function update($uuid, $updateData){
       return $this->stateRepository->updateData($uuid, $updateData);
    }

    public function destroy($uuid){
        return $this->stateRepository->deleteData($uuid);
    }


}