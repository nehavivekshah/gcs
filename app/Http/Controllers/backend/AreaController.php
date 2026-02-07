<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Services\AreaService;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    function __construct(protected AreaService $areaService)
    {
    }

    function index()
    {

        $areaList = $this->areaService->index();
        $cityList = $this->areaService->getCity();
        $stateList = $this->areaService->getState(); // I should check if getState exists in AreaService or if I need to use getCity().
        return view('backend/area/area-list', compact('areaList', 'cityList', 'stateList'));
    }


    function create()
    {
        $cityList = $this->areaService->getCity();
        return view('backend/area/add-area', compact('cityList'));
    }


    function store(Request $req)
    {

        $area = $req->area;
        $state_id = $req->state_id;
        $city_id = $req->city_id;
        $created_by = session('user_name', 'Guest');
        $data = ['state_id' => $state_id, 'city_id' => $city_id, 'area' => $area, 'created_by' => $created_by];
        $this->areaService->store($data);

        return redirect()->route('admin.area.index');
    }


    function edit(Request $req, $uuid)
    {

        $uuid = $req->uuid;
        $area = $this->areaService->edit($uuid);
        $cityList = $this->areaService->getCity();
        $state_id = $area->state_id;
        $stateList = $this->areaService->getStateId($state_id);
        return view('backend/area/edit-area', compact('area', 'cityList', 'stateList'));
    }

    function update(Request $req, $uuid)
    {

        $area = $req->area;
        $state_id = $req->state_id;
        $city_id = $req->city_id;
        $modified_by = session('user_name', 'Guest');
        $data = ['area' => $area, 'state_id' => $state_id, 'city_id' => $city_id, 'modified_by' => $modified_by];

        $update = $this->areaService->update($uuid, $data);

        if ($update) {
            return redirect()->route('admin.area.index')->with('success', 'Update Success ...');
        } else {
            return redirect()->route('admin.area.index')->with('error', 'Not Update ...');
        }
    }

    function destroy($uuid)
    {

        $delete = $this->areaService->destroy($uuid);

        if ($delete) {
            return redirect()->route('admin.area.index')->with('success', 'Delete Success ...');
        } else {
            return redirect()->route('admin.area.index')->with('error', 'Not Delete ...');
        }
    }


    public function getStateCities(Request $request)
    {
        $state_id = $request->stateID;

        $cities = $this->areaService->getStateCity($state_id);

        return response()->json($cities);
    }


    public function getCityStates(Request $request)
    {
        $city_id = $request->cityID;

        $city_result = $this->areaService->getCityId($city_id);
        $state_id = $city_result->state_id;

        $states = $this->areaService->getStateId($state_id);

        return response()->json($states);
    }


}
