<?php

namespace App\Services;

use App\Repository\UserRepository;
use App\Models\UserType;

class UserService
{

   function __construct(protected UserRepository $userRepository)
   {
   }

   public function index()
   {
      return $this->userRepository->getAllData();
   }

   public function store($data)
   {
      return $this->userRepository->createData($data);
   }

   public function edit($uuid)
   {
      return $this->userRepository->getDataById($uuid);
   }

   public function update($uuid, $updateData)
   {
      return $this->userRepository->updateData($uuid, $updateData);
   }

   public function destroy($uuid)
   {
      return $this->userRepository->deleteData($uuid);
   }

   function gatAllUserType()
   {
      return UserType::select('id', 'uuid', 'user_type')->where('id', '!=', 4)->get();
   }

}