<?php

namespace App\Services;

use App\Repository\CityRepository;
use App\Models\States;

class CityService{

   function __construct(protected CityRepository $cityRepository){} 
   
   public function index(){
      return $this->cityRepository->getAllData();
    }

    public function store($data){
       return $this->cityRepository->createData($data);
    }

    public function edit($uuid){
       return $this->cityRepository->getDataById($uuid);
    }

    public function update($uuid, $updateData){
       return $this->cityRepository->updateData($uuid, $updateData);
    }

    public function destroy($uuid){
        return $this->cityRepository->deleteData($uuid);
    }

    public function getState(){
         return States::select('id','uuid','state')->get();
    }


}