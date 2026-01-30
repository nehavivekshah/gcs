<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Services\UserTypeService;
use Illuminate\Http\Request;

class UserTypeController extends Controller
{
    function __construct(protected UserTypeService $userTypeService){}

    function index(){
       
        $userTypeList = $this->userTypeService->index();
        return view('backend/user-type/user-type-list', compact('userTypeList'));
    }


    function create(){

       return view('backend/user-type/add-user-type');
    }

    function store(Request $req){

       $userType = $req->user_type;
       $created_by = session('user_name', 'Guest');

        $data = ['user_type' => $userType, 'created_by' => $created_by];
        $this->userTypeService->store($data);
        
        return redirect()->route('admin.user-type.index');
    }


     function edit(Request $req){

        $uuid = $req->uuid;
        $userType = $this->userTypeService->edit($uuid);
        return view('backend/user-type/edit-user-type', compact('userType'));
    }

    function update(Request $req, $uuid){

        $userType = $req->user_type;

        $modified_by = session('user_name', 'Guest');
        $data = ['user_type' => $userType, 'modified_by' => $modified_by];

        $update = $this->userTypeService->update($uuid, $data);

        if($update) {
            return redirect()->route('admin.user-type.index')->with('success','Update Success ...');
        }else{
            return redirect()->route('admin.user-type.index')->with('error','Not Update ...');
        }
    }

    function destroy($uuid){

        $delete = $this->userTypeService->destroy($uuid);

        if($delete) {
            return redirect()->route('admin.user-type.index')->with('success','Delete Success ...');
        }else{
            return redirect()->route('admin.user-type.index')->with('error','Not Delete ...');
        }

    }
}
