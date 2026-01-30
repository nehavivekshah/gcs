<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Services\AmcProductService;
use Illuminate\Http\Request;

class AmcProductController extends Controller
{    
    function __construct(protected AmcProductService $amcProductService){}

    function index(){
       
        $amcProductList = $this->amcProductService->index();
        return view('backend/amc-product/amc-product-list', compact('amcProductList'));
    }


    function create(){

        return view('backend/amc-product/add-amc-product');
    }

    function store(Request $req){

        $amc_product = $req->amc_product;
        $non_comp_amc_rate = $req->non_comp_amc_rate;
        $comp_amc_rate = $req->comp_amc_rate;
        $created_by = session('user_name', 'Guest');
        
        $data = ['amc_product' => $amc_product, 'non_comp_amc_rate' => $non_comp_amc_rate, 'comp_amc_rate' => $comp_amc_rate, 'created_by' => $created_by];
        $this->amcProductService->store($data);
        
        return redirect()->route('admin.amc-product.index');

    }


    function edit(Request $req, $uuid){

        $uuid = $req->uuid;
        $amcProduct = $this->amcProductService->edit($uuid);
        return view('backend/amc-product/edit-amc-product', compact('amcProduct'));
    }

    function update(Request $req, $uuid){

        $amc_product = $req->amc_product;
        $non_comp_amc_rate = $req->non_comp_amc_rate;
        $comp_amc_rate = $req->comp_amc_rate;
        $modified_by = session('user_name', 'Guest');
        
        $data = ['amc_product' => $amc_product, 'non_comp_amc_rate' => $non_comp_amc_rate, 'comp_amc_rate' => $comp_amc_rate, 'modified_by' => $modified_by];
        $update = $this->amcProductService->update($uuid, $data);

        if($update) {
            return redirect()->route('admin.amc-product.index')->with('success','Update Success ...');
        }else{
            return redirect()->route('admin.amc-product.index')->with('error','Not Update ...');
        }
    }

    function destroy($uuid){

        $delete = $this->amcProductService->destroy($uuid);

        if($delete) {
            return redirect()->route('admin.amc-product.index')->with('success','Delete Success ...');
        }else{
            return redirect()->route('admin.amc-product.index')->with('error','Not Delete ...');
        }

    }

}
