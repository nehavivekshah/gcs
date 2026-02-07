<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;

use App\Services\CustomerComplaintService;

use Illuminate\Http\Request;
use App\Models\Customer;

class CompanyComplaintController extends Controller
{
    function __construct(protected CustomerComplaintService $customerComplaintService){
    }

    function index()
    {

        $customerComplaintList = $this->customerComplaintService->index();
        $engineerList = $this->customerComplaintService->getEngineerList();
        $customerList = $this->customerComplaintService->getCustomerList();
        return view('backend.company-complaint.company-complaint-list', compact('customerComplaintList','engineerList','customerList'));
    }

    function store(Request $request){

        $company_id  = $request->company_id;
        $branch_id  = $request->branch_id;
        $product_id  = $request->product_id;
        $department_id  = $request->department_id;
        $category_type  = $request->category_type;
        $complaint_mode  = $request->complaint_mode;
        $product_uin  = $request->product_uin;
        $description  = $request->description;
        $user_name  = $request->user_name;
        $expected_time  = $request->expected_time;
        $engineer_id  = $request->engineer_id;
        $call_type  = $request->call_type;
        $call_logged_by  = $request->call_logged_by;
        $call_status  = $request->call_status;
        $confirm_by  = $request->confirm_by;
        $created_by = session('user_name', 'Guest');

        $data = [
            'customer_id' => $company_id,
            'company_id' => $company_id,
            'department_id' => $department_id,
            'branch_id' => $branch_id,
            'product_id' => $product_id,
            'category_type' => $category_type,
            'complaint_mode' => $complaint_mode,
            'product_uin' => $product_uin,
            'description' => $description,
            'user_name' => $user_name,
            'expected_time' => $expected_time,
            'engineer_id' => $engineer_id,
            'call_type' => $call_type,
            'call_logged_by' => $call_logged_by,
            'call_status' => $call_status,
            'confirm_by' => $confirm_by,
            'created_by' => $created_by,
        ];

        $this->customerComplaintService->store($data);

        return redirect()->back()->with('success', 'Customer Complaint Created Successfully');
    }

   

    public function update(Request $request){
        
        $uuid = $request->uuid;
        $company_id  = $request->company_id;
        $branch_id  = $request->branch_id;
        $product_id  = $request->product_id;
        $category_type  = $request->category_type;
        $complaint_mode  = $request->complaint_mode;
        $product_uin  = $request->product_uin;
        $description  = $request->description;
        $user_name  = $request->user_name;
        $expected_time  = $request->expected_time;
        $department_id  = $request->department_id;
        $engineer_id  = $request->engineer_id;
        $call_type  = $request->call_type;
        $call_logged_by  = $request->call_logged_by;
        $call_status  = $request->call_status;
        $confirm_by  = $request->confirm_by;
        $modified_by = session('user_name', 'Guest');

        $data = [
            'company_id' => $company_id,
            'customer_id' => $company_id,
            'branch_id' => $branch_id,
            'department_id' => $department_id,
            'product_id' => $product_id,
            'category_type' => $category_type,
            'complaint_mode' => $complaint_mode,
            'product_uin' => $product_uin,
            'description' => $description,
            'user_name' => $user_name,
            'expected_time' => $expected_time,
            'engineer_id' => $engineer_id,
            'call_type' => $call_type,
            'call_logged_by' => $call_logged_by,
            'call_status' => $call_status,
            'confirm_by' => $confirm_by,
            'modified_by' => $modified_by
        ];

        $this->customerComplaintService->update($uuid, $data);

        return redirect()->back()->with('success', 'Customer Complaint Updated Successfully');
    }


    function destroy($uuid)
    {

        $this->customerComplaintService->destroy($uuid);

        return redirect()->back()->with('success', 'Customer Complaint Deleted Successfully');
    }


    public function getVisitDetails(Request $request){
        $complaint_id = $request->complaint_id;
        $visitDetails = $this->customerComplaintService->getVisitDetails($complaint_id);
        return response()->json($visitDetails);
    }


    function addComplaintVisit(Request $request){

        $complaint_id  = $request->customer_complaint_id;
        $customer_id  = $request->customer_id;
        $call_status  = $request->call_status;
        $reason_for_delay  = $request->reason_for_delay;
        $expected_time  = $request->expected_time;
        $call_logged_by  = $request->call_logged_by;
        $engineer_id  = $request->engineer_id;
        $created_by = session('user_name', 'Guest');

        $data = [
            'complaint_id' => $complaint_id,
            'customer_id' => $customer_id,
            'call_status' => $call_status,
            'reason_for_delay' => $reason_for_delay,
            'expected_time' => $expected_time,
            'call_logged_by' => $call_logged_by,
            'engineer_id' => $engineer_id,
            'created_by' => $created_by,
        ];

        $this->customerComplaintService->addComplaintVisit($data);

        return redirect()->back()->with('success', 'Complaint Visit Added Successfully');
    }


    function updateComplaintVisit(Request $request){

        $id  = $request->visit_id;
        $call_status  = $request->call_status;
        $reason_for_delay  = $request->reason_for_delay;
        $expected_time  = $request->expected_time;
        $call_logged_by  = $request->call_logged_by;
        $engineer_id  = $request->engineer_id;
        $modified_by = session('user_name', 'Guest');

        $data = [
            'call_status' => $call_status,
            'reason_for_delay' => $reason_for_delay,
            'expected_time' => $expected_time,
            'call_logged_by' => $call_logged_by,
            'engineer_id' => $engineer_id,
            'modified_by' => $modified_by,
        ];

        $this->customerComplaintService->updateComplaintVisit($id,$data);
        
        return redirect()->back()->with('success', 'Complaint Visit Updated Successfully');
    }


    function deleteComplaintVisit($id){

        $this->customerComplaintService->deleteComplaintVisit($id);
        
        return redirect()->back()->with('success', 'Complaint Visit Deleted Successfully');
    }

    
    public function getProducts(Request $request)
    {
        $products = $this->customerComplaintService->getCustomerProducts($request->customer_id);
        return response()->json(['status' => true, 'data' => $products]);
    }


    public function getCustomerBranch(Request $request)
    {
        $company_id = $request->companyID;

        $branchs = $this->customerComplaintService->getCustomerBranch($company_id);

        return response()->json($branchs);
    }

    public function getCustomerDepartment(Request $request)
    {
        $branch_id = $request->branchID;

        $departments = $this->customerComplaintService->getCustomerDepartment($branch_id);

        return response()->json($departments);
    }

    public function getCustomerDepartmentProduct(Request $request)
    {
         $department_id = $request->departmentID;

         $products = $this->customerComplaintService->getCustomerDepartmentProduct($department_id);

         return response()->json($products);
    }


}
