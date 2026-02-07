<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CoordinatorService;

class CoordinatorController extends Controller
{
    function __construct(protected CoordinatorService $coordinatorService)
    {
    }

    function index()
    {

        $coordinatorList = $this->coordinatorService->index();
        $userTypeList = $this->coordinatorService->gatAllUserType();
        return view('backend/coordinator/coordinator-list', compact('coordinatorList', 'userTypeList'));
    }


    function create()
    {

        $userTypeList = $this->coordinatorService->gatAllUserType();
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
        $this->coordinatorService->store($data);

        return redirect()->route('admin.coordinator.index');

    }


    function edit(Request $req)
    {

        $uuid = $req->uuid;
        $coordinators = $this->coordinatorService->edit($uuid);
        $userTypeList = $this->coordinatorService->gatAllUserType();
        return view('backend/coordinator/edit-coordinator', compact('coordinators'));
    }

    function update(Request $req, $uuid)
    {

        $userName = $req->user_name;
        $userPassword = $req->user_password;
        $outlookEmail = $req->outlook_email;
        $outlookPassword = $req->outlook_password;

        $modified_by = session('user_name', 'Guest');

        $data = ['user_name' => $userName, 'password' => $userPassword, 'outlook_email' => $outlookEmail, 'outlook_password' => $outlookPassword, 'modified_by' => $modified_by];

        $update = $this->coordinatorService->update($uuid, $data);

        if ($update) {
            return redirect()->route('admin.coordinator.index')->with('success', 'Update Success ...');
        } else {
            return redirect()->route('admin.coordinator.index')->with('error', 'Not Update ...');
        }
    }

    function destroy($uuid)
    {

        $delete = $this->coordinatorService->destroy($uuid);

        if ($delete) {
            return redirect()->route('admin.coordinator.index')->with('success', 'Delete Success ...');
        } else {
            return redirect()->route('admin.coordinator.index')->with('error', 'Not Delete ...');
        }

    }

}
