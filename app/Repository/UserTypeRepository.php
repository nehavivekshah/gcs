<?php

namespace App\Repository;

use App\Models\UserType;

class UserTypeRepository
{
    function getAllData()
    {
        return UserType::where('id', '!=', 4)->get();
    }

    function createData($data)
    {
        return UserType::create($data);
    }

    function getDataById($uuid)
    {
        return UserType::where('uuid', $uuid)->first();
    }

    function updateData($uuid, $data)
    {
        return UserType::where('uuid', $uuid)->update($data);
    }

    function deleteData($uuid)
    {
        return UserType::where('uuid', $uuid)->delete();
    }

}

?>