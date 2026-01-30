<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Services\ProductAccessoriesService;
use Illuminate\Http\Request;

class ProductAccessoriesController extends Controller
{
    function __construct(protected ProductAccessoriesService $productAccessoriesService){}

    function index(){
       
        $productAccessoriesList = $this->productAccessoriesService->index();
        return view('backend/product-accessories/product-accessories-list',compact('productAccessoriesList'));
    }

    function create(){

        return view('backend/product-accessories/add-product-accessories');
    }

    function store(Request $req){

        $accessories = $req->accessories;
        $created_by = session('user_name', 'Guest');

        $data = ['accessories' => $accessories, 'created_by' => $created_by];
        $this->productAccessoriesService->store($data);
        
        return redirect()->route('admin.product-accessories.index');

    }

    function edit(Request $req, $uuid){

        $uuid = $req->uuid;
        $accessories = $this->productAccessoriesService->edit($uuid);

        return view('backend/product-accessories/edit-product-accessories', compact('accessories'));
    }

    function update(Request $req, $uuid){

        $accessories = $req->accessories;
        $modified_by = session('user_name', 'Guest');
        $data = ['accessories' => $accessories, 'modified_by' => $modified_by];
        
        $update = $this->productAccessoriesService->update($uuid, $data);

        if($update) {
            return redirect()->route('admin.product-accessories.index')->with('success','Update Success ...');
        }else{
            return redirect()->route('admin.product-accessories.index')->with('error','Not Update ...');
        }
    }

    function destroy($uuid){

        $delete = $this->productAccessoriesService->destroy($uuid);

        if($delete) {
            return redirect()->route('admin.product-accessories.index')->with('success','Delete Success ...');
        }else{
            return redirect()->route('admin.product-accessories.index')->with('error','Not Delete ...');
        }

    }
}
