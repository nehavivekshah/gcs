<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Engineer;
use App\Models\CustomerComplaintVisit;
use App\Models\CustomerProduct;
use App\Models\CustomerBranch;
use App\Models\CustomerDepartment;


use App\Repository\CustomerComplaintRepository;

class CustomerComplaintService
{


   function __construct(protected CustomerComplaintRepository $customerComplaintRepository) {}

   public function index()
   {
      return $this->customerComplaintRepository->getAllData();
   }

   public function store($data)
   {
      return $this->customerComplaintRepository->createData($data);
   }

   public function edit($uuid)
   {
      return $this->customerComplaintRepository->getDataById($uuid);
   }

   public function update($uuid, $updateData)
   {
      return $this->customerComplaintRepository->updateData($uuid, $updateData);
   }

   public function destroy($uuid)
   {
      return $this->customerComplaintRepository->deleteData($uuid);
   }

   public function getCustomerList()
   {
      return Customer::select('id', 'uuid', 'company_name')->get();
   }

   public function getEngineerList()
   {
      return Engineer::select('id', 'uuid', 'name')->get();
   }

   public function getVisitDetails($complaint_id)
   {
      return CustomerComplaintVisit::select('customer_complaint_visits.*', 'engineers.name as engineer_name')
         ->leftjoin('engineers', 'customer_complaint_visits.engineer_id', '=', 'engineers.id')
         ->where('complaint_id', $complaint_id)->get();
   }

   public function addComplaintVisit($data)
   {

      $visiting = CustomerComplaintVisit::create($data);

      $count = CustomerComplaintVisit::count(); // total rows
      $visiting->complaint_no = $count;
      $visiting->save();

      return $visiting;
   }

   function updateComplaintVisit($id, $data)
   {
      return CustomerComplaintVisit::where('id', $id)->update($data);
   }

   function deleteComplaintVisit($id)
   {
      return CustomerComplaintVisit::where('id', $id)->delete();
   }

   public function getCustomerProducts($company_id)
   {
      return CustomerProduct::where('customer_products.customer_id', $company_id)
         ->select('customer_products.*','amc_products.id as product_id', 'amc_products.amc_product')
         ->leftJoin('amc_products', 'customer_products.amc_product_id', '=', 'amc_products.id')
         ->get();
   }

   public function getCustomerBranch($company_id)
   {
      return CustomerBranch::where('customer_branches.customer_id', $company_id)
         ->select('customer_branches.*')->get();
   }


   public function getCustomerDepartment($branch_id)
   {
      return CustomerDepartment::where('branch_id', $branch_id)
         ->select('customer_departments.*')->get();
   }

   public function getCustomerDepartmentProduct($department_id)
   {
      return CustomerProduct::where('customer_products.department_id', $department_id)
         ->select('customer_products.*','amc_products.id as product_id', 'amc_products.amc_product')
         ->leftJoin('amc_products', 'customer_products.amc_product_id', '=', 'amc_products.id')
         ->get();
   }

}
