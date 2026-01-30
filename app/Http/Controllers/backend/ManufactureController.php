<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Services\ManufactureService;
use Illuminate\Http\Request;

class ManufactureController extends Controller
{
    function __construct(protected ManufactureService $manufactureService){}
    
    function index(){
       
        $manufacturesList = $this->manufactureService->index();
        return view('backend/manufacture/manufacture-list', compact('manufacturesList'));
    }

    function create(){

        return view('backend/manufacture/add-manufacture');
    }

    function store(Request $req){

        $manufacture = $req->manufacture;
        $created_by = session('user_name', 'Guest');

        $data = ['manufacture' => $manufacture, 'created_by' => $created_by];
        $this->manufactureService->store($data);
        
        return redirect()->route('admin.manufacture.index');

    }

    function edit(Request $req, $uuid){

        $uuid = $req->uuid;
        $manufactures = $this->manufactureService->edit($uuid);
        return view('backend/manufacture/edit-manufacture', compact('manufactures'));
    }

    function update(Request $req, $uuid){

        $manufacture = $req->manufacture;
        $modified_by = session('user_name', 'Guest');
        $data = ['manufacture' => $manufacture, 'modified_by' => $modified_by];
        
        $update = $this->manufactureService->update($uuid, $data);

        if($update) {
            return redirect()->route('admin.manufacture.index')->with('success','Update Success ...');
        }else{
            return redirect()->route('admin.manufacture.index')->with('error','Not Update ...');
        }
    }

    function destroy($uuid){

        $delete = $this->manufactureService->destroy($uuid);

        if($delete) {
            return redirect()->route('admin.manufacture.index')->with('success','Delete Success ...');
        }else{
            return redirect()->route('admin.manufacture.index')->with('error','Not Delete ...');
        }

    }
    
}
