<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Services\ProductInwardOutwardService;

class ProductInwardOutwardController extends Controller
{
    function __construct(protected ProductInwardOutwardService $productInwardOutwardService) {}

    function index()
    {

        $productInwardOutwardList = $this->productInwardOutwardService->index();

        $customerList = $this->productInwardOutwardService->getCustomerList();
        $engineerList = $this->productInwardOutwardService->getEngineerList();
        $supplierList = $this->productInwardOutwardService->getSupplierList();
        $manufactureList = $this->productInwardOutwardService->getManufactureList();
        return view('backend/product-inward-outward/product-inward-outward-list', compact('productInwardOutwardList', 'customerList', 'engineerList', 'supplierList', 'manufactureList'));
    }


    function store(Request $req)
    {

        $company_id = $req->company_id;
        $branch_id = $req->branch_id;
        $department_id = $req->department_id;
        $product_id = $req->product_id;
        $manufacture_id = $req->manufacture_id;
        $location = $req->location;
        $call_status = $req->call_status;
        $supplier_id = $req->supplier_id;
        $inward_engineer = $req->inward_engineer;
        $outward_engineer = $req->outward_engineer;
        $inward_tp_date = $req->inward_tp_date;
        $outward_tp_date = $req->outward_tp_date;
        $tp_inward_engineer = $req->tp_inward_engineer;
        $tp_outward_engineer = $req->tp_outward_engineer;
        $serial_no = $req->serial_no;
        $third_party_description = $req->third_party_description;
        $product_condition = $req->product_condition;
        $description = $req->description;
        $created_by = session('user_name', 'Guest');

        $data = [
            'company_id' => $company_id,
            'branch_id' => $branch_id,
            'department_id' => $department_id,
            'product_id' => $product_id,
            'manufacture_id' => $manufacture_id,
            'location' => $location,
            'call_status' => $call_status,
            'supplier_id' => $supplier_id,
            'inward_engineer' => $inward_engineer,
            'outward_engineer' => $outward_engineer,
            'inward_tp_date' => $inward_tp_date,
            'outward_tp_date' => $outward_tp_date,
            'tp_inward_engineer' => $tp_inward_engineer,
            'tp_outward_engineer' => $tp_outward_engineer,
            'serial_no' => $serial_no,
            'third_party_description' => $third_party_description,
            'product_condition' => $product_condition,
            'description' => $description,
            'created_by' => $created_by
        ];

        $this->productInwardOutwardService->store($data);

        return redirect()->route('admin.product.inward.outward.index');
    }


    function update(Request $req)
    {

        $id = $req->id;
        $uuid = $req->uuid;
        $company_id = $req->company_id;
        $branch_id = $req->branch_id;
        $product_id = $req->product_id;
        $manufacture_id = $req->manufacture_id;
        $location = $req->location;
        $call_status = $req->call_status;
        $supplier_id = $req->supplier_id;
        $inward_engineer = $req->inward_engineer;
        $outward_engineer = $req->outward_engineer;
        $inward_tp_date = $req->inward_tp_date;
        $outward_tp_date = $req->outward_tp_date;
        $tp_inward_engineer = $req->tp_inward_engineer;
        $tp_outward_engineer = $req->tp_outward_engineer;
        $serial_no = $req->serial_no;
        $third_party_description = $req->third_party_description;
        $product_condition = $req->product_condition;
        $description = $req->description;
        $modified_by = session('user_name', 'Guest');

        $data = [
            'company_id' => $company_id,
            'branch_id' => $branch_id,
            'product_id' => $product_id,
            'manufacture_id' => $manufacture_id,
            'location' => $location,
            'call_status' => $call_status,
            'supplier_id' => $supplier_id,
            'inward_engineer' => $inward_engineer,
            'outward_engineer' => $outward_engineer,
            'inward_tp_date' => $inward_tp_date,
            'outward_tp_date' => $outward_tp_date,
            'tp_inward_engineer' => $tp_inward_engineer,
            'tp_outward_engineer' => $tp_outward_engineer,
            'serial_no' => $serial_no,
            'third_party_description' => $third_party_description,
            'product_condition' => $product_condition,
            'description' => $description,
            'modified_by' => $modified_by
        ];

        $this->productInwardOutwardService->update($uuid, $data);

        return redirect()->route('admin.product.inward.outward.index')->with('success', 'Update Success ...');
    }


    function destroy($uuid)
    {

        $delete = $this->productInwardOutwardService->destroy($uuid);

        if ($delete) {
            return redirect()->route('admin.product.inward.outward.index')->with('success', 'Delete Success ...');
        } else {
            return redirect()->route('admin.product.inward.outward.index')->with('error', 'Not Delete ...');
        }
    }


    public function getCustomerBranch(Request $request)
    {
        $company_id = $request->companyID;

        $branchs = $this->productInwardOutwardService->getCustomerBranch($company_id);

        return response()->json($branchs);
    }

    public function getCustomerDepartment(Request $request)
    {
        $branch_id = $request->branchID;

        $departments = $this->productInwardOutwardService->getCustomerDepartment($branch_id);

        return response()->json($departments);
    }

    public function getCustomerDepartmentProduct(Request $request)
    {
         $department_id = $request->departmentID;

         $products = $this->productInwardOutwardService->getCustomerDepartmentProduct($department_id);

         return response()->json($products);
    }

}
