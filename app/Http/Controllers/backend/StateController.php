<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Services\StateService;
use Illuminate\Http\Request;

class StateController extends Controller
{
    function __construct(protected StateService $stateService){}

     function index(){
       
        $stateList = $this->stateService->index();
        return view('backend/state/state-list', compact('stateList'));
    }

    function create(){

        return view('backend/state/add-state');
    }

    function store(Request $req){

        $state = $req->state;
        $created_by = session('user_name', 'Guest');

        $data = ['state' => $state, 'created_by' => $created_by];
        $this->stateService->store($data);
        
        return redirect()->route('admin.state.index');

    }

    function edit(Request $req, $uuid){

        $uuid = $req->uuid;
        $states = $this->stateService->edit($uuid);

        return view('backend/state/edit-state', compact('states'));
    }

    function update(Request $req, $uuid){

        $state = $req->state;
        $modified_by = session('user_name', 'Guest');

        $data = ['state' => $state, 'modified_by' => $modified_by];
        
        $update = $this->stateService->update($uuid, $data);

        if($update) {
            return redirect()->route('admin.state.index')->with('success','Update Success ...');
        }else{
            return redirect()->route('admin.state.index')->with('error','Not Update ...');
        }
    }

    function destroy($uuid){

        $delete = $this->stateService->destroy($uuid);

        if($delete) {
            return redirect()->route('admin.state.index')->with('success','Delete Success ...');
        }else{
            return redirect()->route('admin.state.index')->with('error','Not Delete ...');
        }

    }
}
