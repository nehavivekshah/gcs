<?php

namespace App\Services;

use App\Repository\UserTypeRepository;

class UserTypeService{

   function __construct(protected UserTypeRepository $userTypeRepository){} 
   
   public function index(){
      return $this->userTypeRepository->getAllData();
    }

    public function store($data){
       return $this->userTypeRepository->createData($data);
    }

    public function edit($uuid){
       return $this->userTypeRepository->getDataById($uuid);
    }

    public function update($uuid, $updateData){
       return $this->userTypeRepository->updateData($uuid, $updateData);
    }

    public function destroy($uuid){
        return $this->userTypeRepository->deleteData($uuid);
    }


}