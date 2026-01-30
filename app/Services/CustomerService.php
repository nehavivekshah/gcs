<?php

namespace App\Services;

use App\Repository\CustomerRepository;
use App\Models\States;
use App\Models\Cities;
use App\Models\Area;
use App\Models\Customer;
use App\Models\CustomerBranch;
use App\Models\AmcProduct;
use App\Models\CustomerProduct;
use App\Models\CustomerContact;
use App\Models\UserCredential;
use App\Models\Engineer;
use App\Models\CustomerBranchContact;


class CustomerService
{

     function __construct(protected CustomerRepository $customerRepository)
     {
     }

     public function index()
     {
          return $this->customerRepository->getAllData();
     }

     public function store($data)
     {
          return $this->customerRepository->createData($data);
     }

     public function edit($uuid)
     {
          return $this->customerRepository->getDataById($uuid);
     }

     public function update($uuid, $updateData)
     {
          return $this->customerRepository->updateData($uuid, $updateData);
     }

     public function destroy($uuid)
     {
          return $this->customerRepository->deleteData($uuid);
     }

     public function getState()
     {
          return States::select('id', 'uuid', 'state')->get();
     }

     public function getArea()
     {
          return Area::select('id', 'uuid', 'area')->get();
     }

     public function getStateCity($id)
     {
          return Cities::select('id', 'uuid', 'state_id', 'city')->where('state_id', $id)->get();
     }

     public function getCityArea($id)
     {
          return Area::select('id', 'uuid', 'city_id', 'area')->where('city_id', $id)->get();
     }

     public function getCustomerContact($customer_id)
     {

          return CustomerContact::select('customer_contacts.*', 'customer_branches.branch_name')
               ->leftJoin('customer_branches', 'customer_branches.id', '=', 'customer_contacts.branch_id')
               ->where('customer_contacts.customer_id', $customer_id)
               ->get();
     }

     public function getCustomerBranch($customer_id)
     {

          return CustomerBranch::where('customer_branches.customer_id', $customer_id)
               ->select(
                    'customer_branches.id',
                    'customer_branches.uuid',
                    'customer_branches.customer_id',
                    'customer_branches.branch_name',
                    'customer_branches.contact_person',
                    'customer_branches.mobile_no',
                    'customer_branches.customer_code',
                    'customer_branches.email',
                    'customer_branches.phone',
                    'customer_branches.address_line_1',
                    'customer_branches.address_line_2',
                    'customer_branches.state_id',
                    'customer_branches.state_id',
                    'customer_branches.city_id',
                    'customer_branches.area_id',
                    'customer_branches.pincode',
                    'customer_branches.fax',
                    'customer_branches.created_by',
                    'customer_branches.modified_by',
                    'S.state as state_name',
                    'C.city as city_name',
                    'A.area as area_name',
               )
               ->leftJoin('states as S', 'S.id', '=', 'customer_branches.state_id')
               ->leftJoin('cities as C', 'C.id', '=', 'customer_branches.city_id')
               ->leftJoin('areas as A', 'A.id', '=', 'customer_branches.area_id')
               ->get();
     }


     public function addCustomerBranch($data)
     {
          return CustomerBranch::create($data);
     }


     function editCustomerBranch($id, $data)
     {
          return CustomerBranch::where('id', $id)->update($data);
     }

     function getCustomerId()
     {
          return Customer::latest('id')->first();
     }

     public function getAreaById($id)
     {
          return Area::select('id', 'uuid', 'area', 'city_id', 'state_id')->where('id', $id)->first();
     }

     public function getCityId($id)
     {
          return Cities::select('id', 'state_id', 'city')->where('id', $id)->first();
     }

     public function getStateId($id)
     {
          return States::select('id', 'uuid', 'state')->where('id', $id)->first();
     }

     public function getCity()
     {
          return Cities::select('id', 'uuid', 'city')->get();
     }

     public function getAmcProduct()
     {

          return AmcProduct::select('amc_products.*')->get();
     }

     public function getCustomerBranchByUuid($uuid)
     {
          return CustomerBranch::select('id', 'uuid', 'customer_id', 'branch_name')->where('uuid', $uuid)->first();
     }

     public function getCustomerById($id)
     {
          return Customer::select('id', 'customer_name')->where('id', $id)->first();
     }

     public function getBranchById($id)
     {
          return CustomerBranch::select('id', 'uuid', 'branch_name')->where('id', $id)->first();
     }

     public function getAmcProductById($id)
     {
          return AmcProduct::select('id', 'amc_product')->where('id', $id)->first();
     }

     public function getCustomerProduct($customer_id, $branch_id, $amc_product_id)
     {
          return CustomerProduct::select('customer_products.*', 'E1.name as engnieer_1', 'E2.name as engnieer_2', 'E3.name as engnieer_3')
               ->leftjoin('engineers as E1', 'E1.id', '=', 'customer_products.service_engineer_1')
               ->leftjoin('engineers as E2', 'E2.id', '=', 'customer_products.service_engineer_2')
               ->leftjoin('engineers as E3', 'E3.id', '=', 'customer_products.service_engineer_3')
               ->where(['customer_id' => $customer_id, 'branch_id' => $branch_id, 'amc_product_id' => $amc_product_id])->get();
     }

     public function getCoordinateUser()
     {
          return UserCredential::select('id', 'user_name', 'outlook_email')->where('user_type', 4)->get();
     }

     public function getEngineer()
     {
          return Engineer::select('id', 'name')->get();
     }

     public function addCustomerProduct($data)
     {
          return CustomerProduct::create($data);
     }

     function editCustomerProduct($id, $data)
     {
          return CustomerProduct::where('id', $id)->update($data);
     }

     function deleteCustomerProduct($uuid)
     {
          return CustomerProduct::where('uuid', $uuid)->delete();
     }

     function customerProductById($uuid)
     {
          return CustomerProduct::select('id', 'customer_id', 'branch_id', 'amc_product_id')->where('uuid', $uuid)->first();
     }


     public function addCustomerContact($data)
     {
          return CustomerContact::create($data);
     }

     function editCustomerContact($id, $data)
     {
          return CustomerContact::where('id', $id)->update($data);
     }

     function getCustomerBranchContact($customer_id, $branch_id)
     {
          return CustomerBranchContact::select('customer_branch_contacts.*')->where(['customer_id' => $customer_id, 'branch_id' => $branch_id])->get();
     }

     public function addCustomerBranchContact($data)
     {
          return CustomerBranchContact::create($data);
     }
}
