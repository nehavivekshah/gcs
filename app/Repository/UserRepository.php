<?php

namespace App\Repository;

use App\Models\UserCredential;

class UserRepository
{


    function getAllData()
    {
        return UserCredential::select('users_credentials.*', 'UT.user_type as type')->join('user_types as UT', 'UT.id', '=', 'users_credentials.user_type')->where('UT.id', '!=', 4)->get();
    }

    function createData($data)
    {
        return UserCredential::create($data);
    }

    function getDataById($uuid)
    {
        return UserCredential::where('uuid', $uuid)->first();
    }

    function updateData($uuid, $data)
    {
        return UserCredential::where('uuid', $uuid)->update($data);
    }

    function deleteData($uuid)
    {
        return UserCredential::where('uuid', $uuid)->delete();
    }

}

?>