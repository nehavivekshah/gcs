<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Services\EngineerService;

class EngineerController extends Controller
{
    function __construct(protected EngineerService $engineerService)
    {
    }

    function index()
    {

        $engineerList = $this->engineerService->index();
        return view('backend/engineer/engineer-list', compact('engineerList'));
    }


    function create()
    {

        return view('backend/engineer/add-engineer');
    }

    function store(Request $req)
    {

        $name = $req->user_name;
        $email1 = $req->email1;
        $email2 = $req->email2;
        $phone1 = $req->phone1;
        $phone2 = $req->phone2;
        $designation = $req->designation;
        $created_by = session('user_name', 'Guest');

        $data = ['name' => $name, 'password' => rand(1, 100), 'email1' => $email1, 'email2' => $email2, 'phone1' => $phone1, 'phone2' => $phone2, 'designation' => $designation, 'created_by' => $created_by];
        $this->engineerService->store($data);

        return redirect()->route('admin.engineer.index')->with('success', 'Engineer added successfully.');
    }


    function edit(Request $req)
    {

        $uuid = $req->uuid;
        $engineers = $this->engineerService->edit($uuid);
        return view('backend/engineer/edit-engineer', compact('engineers'));
    }

    function update(Request $req, $uuid)
    {

        $name = $req->user_name;
        $email1 = $req->email1;
        $email2 = $req->email2;
        $phone1 = $req->phone1;
        $phone2 = $req->phone2;
        $designation = $req->designation;
        $modified_by = session('user_name', 'Guest');

        $data = ['name' => $name, 'password' => rand(1, 100), 'email1' => $email1, 'email2' => $email2, 'phone1' => $phone1, 'phone2' => $phone2, 'designation' => $designation, 'modified_by' => $modified_by];

        $update = $this->engineerService->update($uuid, $data);

        if ($update) {
            return redirect()->route('admin.engineer.index')->with('success', 'Update Success ...');
        } else {
            return redirect()->route('admin.engineer.index')->with('error', 'Not Update ...');
        }
    }


    function destroy($uuid)
    {

        $delete = $this->engineerService->destroy($uuid);

        if ($delete) {
            return redirect()->route('admin.engineer.index')->with('success', 'Delete Success ...');
        } else {
            return redirect()->route('admin.engineer.index')->with('error', 'Not Delete ...');
        }

    }

}
