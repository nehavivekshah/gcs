<?php

namespace App\Services;

use App\Repository\ManufactureRepository;

class ManufactureService{

   function __construct(protected ManufactureRepository $manufactureRepository){} 
   
   public function index(){
      return $this->manufactureRepository->getAllData();
    }

    public function store($data){
       return $this->manufactureRepository->createData($data);
    }

    public function edit($uuid){
       return $this->manufactureRepository->getDataById($uuid);
    }

    public function update($uuid, $updateData){
       return $this->manufactureRepository->updateData($uuid, $updateData);
    }

    public function destroy($uuid){
        return $this->manufactureRepository->deleteData($uuid);
    }


}