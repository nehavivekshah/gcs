<?php

namespace App\Services;

use App\Repository\SupplierRepository;
use App\Models\States;
use App\Models\Cities;
use App\Models\Area;
use App\Models\SupplierBranch;
use App\Models\SupplierContact;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;

class SupplierService
{

     function __construct(protected SupplierRepository $supplierRepository) {}

     public function index()
     {
          return $this->supplierRepository->getAllData();
     }

     public function store($data)
     {
          return $this->supplierRepository->createData($data);
     }

     public function edit($uuid)
     {
          return $this->supplierRepository->getDataById($uuid);
     }

     public function update($uuid, $updateData)
     {
          return $this->supplierRepository->updateData($uuid, $updateData);
     }

     public function destroy($uuid)
     {
          return $this->supplierRepository->deleteData($uuid);
     }

     public function getState()
     {
          return States::select('id', 'uuid', 'state')->get();
     }

     public function getCity()
     {
          return Cities::select('id', 'uuid', 'city')->get();
     }

     public function getStateCity($id)
     {
          return Cities::select('id', 'uuid', 'state_id', 'city')->where('state_id', $id)->get();
     }

     public function getArea()
     {
          return Area::select('id', 'uuid', 'area')->get();
     }

     public function getSupplierBranch($supplier_id)
     {

          return SupplierBranch::where('supplier_branch.supplier_id', $supplier_id)
               ->select(
                    'supplier_branch.id',
                    'supplier_branch.uuid',
                    'supplier_branch.branch_name',
                    'supplier_branch.state_id',
                    'supplier_branch.city_id',
                    'supplier_branch.area_id',
                    'supplier_branch.phone_no',
                    'supplier_branch.fax',
                    'supplier_branch.pincode',
                    'supplier_branch.address_line_1',
                    'supplier_branch.address_line_2',
                    'supplier_branch.created_by',
                    'supplier_branch.modified_by',
                    'S.state as state_name',
                    'C.city as city_name',
                    'A.area as area_name',
               )
               ->leftJoin('states as S', 'S.id', '=', 'supplier_branch.state_id')
               ->leftJoin('cities as C', 'C.id', '=', 'supplier_branch.city_id')
               ->leftJoin('areas as A', 'A.id', '=', 'supplier_branch.area_id')
               ->get();
     }

     public function addSupplierBranch($data)
     {
          return SupplierBranch::create($data);
     }

     function editSupplierBranch($id, $data)
     {
          return SupplierBranch::where('id', $id)->update($data);
     }

     public function addSupplierContact($data)
     {
          return SupplierContact::create($data);
     }

     function editSupplierContact($id, $data)
     {
          return SupplierContact::where('id', $id)->update($data);
     }

     public function getAreaById($id)
     {
          return Area::select('id', 'uuid', 'area', 'city_id', 'state_id')->where('id', $id)->first();
     }

     public function getCityId($id)
     {
          return Cities::select('id','state_id','city')->where('id', $id)->first();
     }

     public function getStateId($id)
     {
          return States::select('id', 'uuid', 'state')->where('id', $id)->first();
     }
}
