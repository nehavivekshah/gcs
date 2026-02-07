<?php

namespace App\Services;

use App\Repository\CoordinatorRepository;
use App\Models\UserType;

class CoordinatorService{

   function __construct(protected CoordinatorRepository $coordinatorRepository){} 
   
   public function index(){
      return $this->coordinatorRepository->getAllData();
    }

    public function store($data){
       return $this->coordinatorRepository->createData($data);
    }

    public function edit($uuid){
       return $this->coordinatorRepository->getDataById($uuid);
    }

    public function update($uuid, $updateData){
       return $this->coordinatorRepository->updateData($uuid, $updateData);
    }

    public function destroy($uuid){
        return $this->coordinatorRepository->deleteData($uuid);
    }

    function gatAllUserType(){
       return UserType::select('id','uuid','user_type')->get();
    }

}