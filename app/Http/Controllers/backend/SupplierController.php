<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Services\SupplierService;
use App\Models\Supplier;
use App\Models\SupplierBranch;
use App\Models\SupplierContact;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    function __construct(protected SupplierService $supplierService) {}

    function index()
    {
        $supplierList  = $this->supplierService->index();

        $stateList  = $this->supplierService->getState();
        $cityList  = $this->supplierService->getCity();
        $areaList  = $this->supplierService->getArea();

        return view('backend.supplier.supplier-list', compact('supplierList', 'stateList', 'cityList', 'areaList'));
    }

    function create()
    {

        $areaList  = $this->supplierService->getArea();
        return view('backend.supplier.add-supplier', compact('areaList'));
    }

    public function store(Request $req)
    {
        $supplier_name    = $req->supplier_name;
        $mobile_no        = $req->mobile_no;
        $contact_person   = $req->contact_person;
        $email            = $req->email;
        $phone_1          = $req->phone_1;
        $phone_2          = $req->phone_2;
        $address_line_1   = $req->address_line_1;
        $address_line_2   = $req->address_line_2;
        $state_id         = $req->state_id;
        $city_id          = $req->city_id;
        $area_id          = $req->area_id;
        $pincode          = $req->pincode;
        $pan              = $req->pan;
        $vat              = $req->vat;
        $tin              = $req->tin;
        $gst              = $req->gst;
        $cst              = $req->cst;
        $fax              = $req->fax;
        $web_sites        = $req->web_sites;
        $created_by = session('user_name', 'Guest');

        $data = [
            'supplier_name'  => $supplier_name,
            'mobile_no'      => $mobile_no,
            'contact_person' => $contact_person,
            'email'          => $email,
            'phone_1'        => $phone_1,
            'phone_2'        => $phone_2,
            'address_line_1' => $address_line_1,
            'address_line_2' => $address_line_2,
            'state_id'       => $state_id,
            'city_id'        => $city_id,
            'area_id'        => $area_id,
            'pincode'        => $pincode,
            'pan'            => $pan,
            'gst'            => $gst,
            'vat'            => $vat,
            'tin'            => $tin,
            'cst'            => $cst,
            'fax'            => $fax,
            'web_sites'      => $web_sites,
            'created_by'     => $created_by
        ];

        $this->supplierService->store($data);

        return redirect()->route('admin.supplier.index');
    }

    function edit(Request $req, $uuid)
    {

        $uuid = $req->uuid;
        $suppliers = $this->supplierService->edit($uuid);
        $area_id = $suppliers->area_id;
        $areaDetail = $this->supplierService->getAreaById($area_id);
        $areaList  = $this->supplierService->getArea();
        $cityList = $this->supplierService->getCityId($areaDetail->city_id);
        $stateList = $this->supplierService->getStateId($areaDetail->state_id);
    
        return view('backend/supplier/edit-supplier', compact('suppliers', 'stateList', 'cityList', 'areaList'));
    }

    function update(Request $req, $uuid)
    {
        $supplier_name    = $req->supplier_name;
        $mobile_no        = $req->mobile_no;
        $contact_person   = $req->contact_person;
        $email            = $req->email;
        $phone_1          = $req->phone_1;
        $phone_2          = $req->phone_2;
        $address_line_1   = $req->address_line_1;
        $address_line_2   = $req->address_line_2;
        $state_id         = $req->state_id;
        $city_id          = $req->city_id;
        $area_id          = $req->area_id;
        $pincode          = $req->pincode;
        $gst              = $req->gst;
        $pan              = $req->pan;
        $vat              = $req->vat;
        $tin              = $req->tin;
        $cst              = $req->cst;
        $fax              = $req->fax;
        $web_sites        = $req->web_sites;
        $modified_by = session('user_name', 'Guest');

        $data = [
            'supplier_name'  => $supplier_name,
            'mobile_no'      => $mobile_no,
            'contact_person' => $contact_person,
            'email'          => $email,
            'phone_1'        => $phone_1,
            'phone_2'        => $phone_2,
            'address_line_1' => $address_line_1,
            'address_line_2' => $address_line_2,
            'state_id'       => $state_id,
            'city_id'        => $city_id,
            'area_id'        => $area_id,
            'pincode'        => $pincode,
            'gst'            => $gst,
            'pan'            => $pan,
            'vat'            => $vat,
            'tin'            => $tin,
            'cst'            => $cst,
            'fax'            => $fax,
            'web_sites'      => $web_sites,
            'modified_by'     => $modified_by
        ];
        $update = $this->supplierService->update($uuid, $data);

        if ($update) {
            return redirect()->route('admin.supplier.index')->with('success', 'Update Success ...');
        } else {
            return redirect()->route('admin.supplier.index')->with('error', 'Not Update ...');
        }
    }

    function destroy($uuid)
    {

        $delete = $this->supplierService->destroy($uuid);

        if ($delete) {
            return redirect()->route('admin.supplier.index')->with('success', 'Delete Success ...');
        } else {
            return redirect()->route('admin.supplier.index')->with('error', 'Not Delete ...');
        }
    }

    public function view($uuid)
    {
        $supplier = Supplier::with(['state', 'city'])
            ->where('uuid', $uuid)
            ->firstOrFail();

        return response()->json($supplier);
    }

    public function addSupplierBranch(Request $req)
    {

        $supplier_uuid = $req->supplier_uuid;
        $supplier_id = $req->supplier_id;
        $branch_name = $req->branch_name;
        $state_id = $req->state_id;
        $city_id = $req->city_id;
        $area_id = $req->area_id;
        $phone_no = $req->phone_no;
        $fax = $req->fax;
        $pincode = $req->pincode;
        $address_line_1 = $req->address_line_1;
        $address_line_2 = $req->address_line_2;
        $created_by = session('user_name', 'Guest');

        $data = [
            'supplier_id' => $supplier_id,
            'branch_name' => $branch_name,
            'state_id' => $state_id,
            'city_id' => $city_id,
            'area_id' => $area_id,
            'phone_no' => $phone_no,
            'fax' => $fax,
            'pincode' => $pincode,
            'address_line_1' => $address_line_1,
            'address_line_2' => $address_line_2,
            'created_by' => $created_by
        ];

        $this->supplierService->addSupplierBranch($data);

        return redirect()->route('admin.supplier.index');
    }


    public function getSupplierBranch(Request $request)
    {
        $branches = $this->supplierService->getSupplierBranch($request->supplier_id);

        return response()->json($branches);
    }

    function editSupplierBranch(Request $req)
    {

        $id = $req->branch_id;
        $branch_name = $req->branch_name;
        $state_id = $req->state_id;
        $city_id = $req->city_id;
        $area_id = $req->area_id;
        $phone_no = $req->phone_no;
        $fax = $req->fax;
        $pincode = $req->pincode;
        $address_line_1 = $req->address_line_1;
        $address_line_2 = $req->address_line_2;
        $modified_by = session('user_name', 'Guest');

        $data = [
            'branch_name' => $branch_name,
            'state_id' => $state_id,
            'city_id' => $city_id,
            'area_id' => $area_id,
            'phone_no' => $phone_no,
            'fax' => $fax,
            'pincode' => $pincode,
            'address_line_1' => $address_line_1,
            'address_line_2' => $address_line_2,
            'modified_by' => $modified_by
        ];

        $update = $this->supplierService->editSupplierBranch($id, $data);

        if ($update) {
            return redirect()->route('admin.supplier.index')->with('success', 'Update Success ...');
        } else {
            return redirect()->route('admin.supplier.index')->with('error', 'Not Update ...');
        }
    }

    public function deleteSupplierBranch($uuid)
    {
        SupplierBranch::where('uuid', $uuid)->delete();

        return redirect()->back()->with('success', 'Branch deleted successfully');
    }


    function addSupplierContact(Request $request)
    {

        $supplier_id = $request->supplier_id;
        $contact_name = $request->contact_name;
        $email = $request->email;
        $department = $request->department;
        $phone_no = $request->phone_no;
        $created_by = session('user_name', 'Guest');

        $data = ['supplier_id' => $supplier_id, 'contact_name' => $contact_name, 'email' => $email, 'department' => $department, 'phone_no' => $phone_no, 'created_by' => $created_by];

        $this->supplierService->addSupplierContact($data);
        return redirect()->route('admin.supplier.index');
    }


    public function getSupplierContact(Request $request)
    {
        return SupplierContact::where('supplier_id', $request->supplier_id)->get();
    }

    function editSupplierContact(Request $request)
    {

        $id = $request->contact_id;
        $contact_name = $request->contact_name;
        $email = $request->email;
        $department = $request->department;
        $phone_no = $request->phone_no;
        $modified_by = session('user_name', 'Guest');

        $data = ['contact_name' => $contact_name, 'email' => $email, 'department' => $department, 'phone_no' => $phone_no, 'modified_by' => $modified_by];

        $update = $this->supplierService->editSupplierContact($id, $data);

        if ($update) {
            return redirect()->route('admin.supplier.index')->with('success', 'Update Success ...');
        } else {
            return redirect()->route('admin.supplier.index')->with('error', 'Not Update ...');
        }
    }


    public function deleteSupplierContact($uuid)
    {
        SupplierContact::where('uuid', $uuid)->delete();

        return redirect()->back()->with('success', 'Contact deleted successfully');
    }


    public function getAreaCities(Request $request)
    {
        $area_id = $request->areaID;

        $area = $this->supplierService->getAreaById($area_id);

        if (!$area) {
            return response()->json(['status' => false]);
        }

        $city = $this->supplierService->getCityId($area->city_id);
        $state = $this->supplierService->getStateId($area->state_id);

        return response()->json([
            'status' => true,
            'city' => [
                'id' => $city->id,
                'name' => $city->city
            ],
            'state' => [
                'id' => $state->id,
                'name' => $state->state
            ]
        ]);
    }



    public function getStateCities(Request $request)
    {
        $state_id = $request->stateID;

        $cities = $delete = $this->supplierService->getStateCity($state_id);

        return response()->json($cities);
    }
}
