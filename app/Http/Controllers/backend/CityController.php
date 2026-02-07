<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Services\CityService;

use Illuminate\Http\Request;

class CityController extends Controller
{
    function __construct(protected CityService $cityService)
    {
    }


    function index()
    {

        $cityList = $this->cityService->index();
        $stateList = $this->cityService->getState();
        return view('backend/city/city-list', compact('cityList', 'stateList'));
    }


    function create()
    {

        $stateList = $this->cityService->getState();
        return view('backend/city/add-city', compact('stateList'));
    }


    function store(Request $req)
    {

        $state_id = $req->state_id;
        $city = $req->city;
        $created_by = session('user_name', 'Guest');

        $data = ['state_id' => $state_id, 'city' => $city, 'created_by' => $created_by];
        $this->cityService->store($data);

        return redirect()->route('admin.city.index');

    }

    function edit(Request $req, $uuid)
    {

        $uuid = $req->uuid;
        $cities = $this->cityService->edit($uuid);
        $stateList = $this->cityService->getState();

        return view('backend/city/edit-city', compact('cities', 'stateList'));
    }


    function update(Request $req, $uuid)
    {

        $state_id = $req->state_id;
        $city = $req->city;
        $modified_by = session('user_name', 'Guest');

        $data = ['state_id' => $state_id, 'city' => $city, 'modified_by' => $modified_by];

        $update = $this->cityService->update($uuid, $data);

        if ($update) {
            return redirect()->route('admin.city.index')->with('success', 'Update Success ...');
        } else {
            return redirect()->route('admin.city.index')->with('error', 'Not Update ...');
        }
    }


    function destroy($uuid)
    {

        $delete = $this->cityService->destroy($uuid);

        if ($delete) {
            return redirect()->route('admin.city.index')->with('success', 'Delete Success ...');
        } else {
            return redirect()->route('admin.city.index')->with('error', 'Not Delete ...');
        }

    }

}
