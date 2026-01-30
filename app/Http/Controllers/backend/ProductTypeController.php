<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Services\ProductTypeService;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    function __construct(protected ProductTypeService $productTypeService){}

    function index(){
       
        $productTypeList = $this->productTypeService->index();
        return view('backend/product-type/product-type-list', compact('productTypeList'));
    }

    function create(){

        return view('backend/product-type/add-product-type');
    }

    function store(Request $req){

        $product_type = $req->product_type;
	$sub_product_type = $req->sub_product_type;
        $created_by = session('user_name', 'Guest');

        $data = ['product_type' => $product_type,'sub_product_type' => $sub_product_type, 'created_by' => $created_by];
        $this->productTypeService->store($data);
        
        return redirect()->route('admin.product-type.index');

    }

    function edit(Request $req, $uuid){

        $uuid = $req->uuid;
        $product_types = $this->productTypeService->edit($uuid);
        return view('backend/product-type/edit-product-type', compact('product_types'));
    }

    function update(Request $req, $uuid){

        $product_type = $req->product_type;
	$sub_product_type = $req->sub_product_type;
        $modified_by = session('user_name', 'Guest');
        
        $data = ['product_type' => $product_type, 'sub_product_type' => $sub_product_type, 'modified_by' => $modified_by];
        
        $update = $this->productTypeService->update($uuid, $data);

        if($update) {
            return redirect()->route('admin.product-type.index')->with('success','Update Success ...');
        }else{
            return redirect()->route('admin.product-type.index')->with('error','Not Update ...');
        }
    }

    function destroy($uuid){

        $delete = $this->productTypeService->destroy($uuid);

        if($delete) {
            return redirect()->route('admin.product-type.index')->with('success','Delete Success ...');
        }else{
            return redirect()->route('admin.product-type.index')->with('error','Not Delete ...');
        }

    }
}
