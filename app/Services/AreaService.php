<?php

namespace App\Services;

use App\Repository\AreaRepository;
use App\Models\States;
use App\Models\Cities;

class AreaService{

   function __construct(protected AreaRepository $areaRepository){} 
   
   public function index(){
      return $this->areaRepository->getAllData();
    }

    public function store($data){
       return $this->areaRepository->createData($data);
    }

    public function edit($uuid){
       return $this->areaRepository->getDataById($uuid);
    }

    public function update($uuid, $updateData){
       return $this->areaRepository->updateData($uuid, $updateData);
    }

    public function destroy($uuid){
        return $this->areaRepository->deleteData($uuid);
    }

    public function getCity(){
         return Cities::select('id','uuid','city')->get();
    }

    public function getStateCity($id){
         return Cities::select('id','uuid','state_id', 'city')->where('state_id',$id)->get();
    }

   public function getCityId($id){
         return Cities::select('id','state_id')->where('id',$id)->first();
   }

   public function getStateId($id){
         return States::select('id','uuid','state')->where('id',$id)->get();
   }


}