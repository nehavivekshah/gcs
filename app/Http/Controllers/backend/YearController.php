<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Services\YearService;

class YearController extends Controller
{
    function __construct(protected YearService $yearService){}

    function index(){
       
        $yearList = $this->yearService->index();
        return view('backend/year/year-list',compact('yearList'));
    }


    function create(){

       return view('backend/year/add-year');
    }

    function store(Request $req){

        $financial_year = $req->financial_year;
        $start_date = $req->start_date;
        $end_date = $req->end_date;
        $created_by = session('user_name', 'Guest');

        $data = ['financial_year' => $financial_year, 'start_date' => $start_date, 'end_date' => $end_date, 'created_by' => $created_by];
        $this->yearService->store($data);
        
        return redirect()->route('admin.year.index');

    }


    function edit(Request $req){

        $uuid = $req->uuid;
        $years = $this->yearService->edit($uuid);

        return view('backend/year/edit-year', compact('years'));
    }

     function update(Request $req, $uuid){

        $financial_year = $req->financial_year;
        $start_date = $req->start_date;
        $end_date = $req->end_date;
        $modified_by = session('user_name', 'Guest');

        $data = ['financial_year' => $financial_year, 'start_date' => $start_date, 'end_date' => $end_date, 'modified_by' => $modified_by];
        $update = $this->yearService->update($uuid, $data);

        if($update) {
            return redirect()->route('admin.year.index')->with('success','Update Success ...');
        }else{
            return redirect()->route('admin.year.index')->with('error','Not Update ...');
        }
    }


     function destroy($uuid){

        $delete = $this->yearService->destroy($uuid);

        if($delete) {
            return redirect()->route('admin.year.index')->with('success','Delete Success ...');
        }else{
            return redirect()->route('admin.year.index')->with('error','Not Delete ...');
        }

    }
}
