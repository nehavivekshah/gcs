<?php

namespace App\Services;

use App\Repository\ProductInwardOutwardRepository;

use App\Models\Customer;
use App\Models\Engineer;
use App\Models\Supplier;
use App\Models\AmcProduct;
use App\Models\Manufacture;
use App\Models\CustomerBranch;
use App\Models\CustomerDepartment;
use App\Models\CustomerProduct;
class ProductInwardOutwardService
{

   function __construct(protected ProductInwardOutwardRepository $productInwardOutwardRepository) {}

   public function index()
   {
      return $this->productInwardOutwardRepository->getAllData();
   }

   public function store($data)
   {
      return $this->productInwardOutwardRepository->createData($data);
   }

   public function edit($uuid)
   {
      return $this->productInwardOutwardRepository->getDataById($uuid);
   }

   public function update($uuid, $updateData)
   {
      return $this->productInwardOutwardRepository->updateData($uuid, $updateData);
   }

   public function destroy($uuid)
   {
      return $this->productInwardOutwardRepository->deleteData($uuid);
   }

   public function getCustomerList()
   {
      return Customer::select('id', 'uuid', 'company_name')->get();
   }

   public function getEngineerList()
   {
      return Engineer::select('id', 'uuid', 'name')->get();
   }
   
   public function getSupplierList()
   {
      return Supplier::select('id', 'uuid', 'supplier_name')->get();
   }
   
   public function getAmcProductList()
   {
      return AmcProduct::select('id', 'uuid', 'amc_product')->get();
   }
   
   public function getManufactureList()
   {
      return Manufacture::select('id', 'uuid', 'manufacture')->get();
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
