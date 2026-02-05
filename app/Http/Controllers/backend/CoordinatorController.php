<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Services\UserService;

use Illuminate\Http\Request;

class CoordinatorController extends Controller
{

    function __construct(protected UserService $userService)
    {
    }

    function index()
    {

        $usersList = $this->userService->index();
        return view('backend/coordinator/coordinator-list', compact('usersList'));
    }


    function create()
    {

        $userTypeList = $this->userService->gatAllUserType();
        return view('backend/coordinator/add-coordinator', compact('userTypeList'));
    }

    function store(Request $req)
    {

        $userName = $req->user_name;
        $userPassword = $req->user_password;
        $outlookEmail = $req->outlook_email;
        $outlookPassword = $req->outlook_password;
        $userType = $req->user_type;
        $host = 'localhost';

        $created_by = session('user_name', 'Guest');

        $data = ['user_name' => $userName, 'password' => $userPassword, 'outlook_email' => $outlookEmail, 'outlook_password' => $outlookPassword, 'user_type' => $userType, 'host' => $host, 'created_by' => $created_by];
        $this->userService->store($data);

        return redirect()->route('admin.user.index');

    }


    function edit(Request $req)
    {

        $uuid = $req->uuid;
        $users = $this->userService->edit($uuid);
        $userTypeList = $this->userService->gatAllUserType();
        return view('backend/user/edit-user', compact('users', 'userTypeList'));
    }

    function update(Request $req, $uuid)
    {

        $userName = $req->user_name;
        $userPassword = $req->user_password;
        $outlookEmail = $req->outlook_email;
        $outlookPassword = $req->outlook_password;
        $userType = $req->user_type;

        $modified_by = session('user_name', 'Guest');

        $data = ['user_name' => $userName, 'password' => $userPassword, 'outlook_email' => $outlookEmail, 'outlook_password' => $outlookPassword, 'user_type' => $userType, 'modified_by' => $modified_by];

        $update = $this->userService->update($uuid, $data);

        if ($update) {
            return redirect()->route('admin.user.index')->with('success', 'Update Success ...');
        } else {
            return redirect()->route('admin.user.index')->with('error', 'Not Update ...');
        }
    }

    function destroy($uuid)
    {

        $delete = $this->userService->destroy($uuid);

        if ($delete) {
            return redirect()->route('admin.user.index')->with('success', 'Delete Success ...');
        } else {
            return redirect()->route('admin.user.index')->with('error', 'Not Delete ...');
        }

    }

}
