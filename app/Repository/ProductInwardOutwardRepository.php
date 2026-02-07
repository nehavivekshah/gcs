<?php

namespace App\Repository;

use App\Models\ProductInwardOutward;

class ProductInwardOutwardRepository
{


    function getAllData()
    {
        return ProductInwardOutward::from('product_inward_outwards as PIO')
        ->select('PIO.*', 'C.company_name', 'CB.branch_name as branch', 'AP.amc_product','S.supplier_name', 'E1.name as inward_engineer_name', 'E2.name as outward_engineer_name','E3.name as tp_inward_engineer_name','E4.name as tp_outward_engineer_name', 'M.manufacture', 'CD.department')
        ->leftJoin('customers as C', 'PIO.company_id', '=', 'C.id')
        ->leftJoin('customer_branches as CB', 'PIO.branch_id', '=', 'CB.id')
        ->leftJoin('suppliers as S', 'PIO.supplier_id', '=', 'S.id')
        ->leftJoin('amc_products as AP', 'PIO.product_id', '=', 'AP.id')
        ->leftJoin('engineers as E1', 'PIO.inward_engineer', '=', 'E1.id')
        ->leftJoin('engineers as E2', 'PIO.outward_engineer', '=', 'E2.id')
        ->leftJoin('manufactures as M', 'PIO.manufacture_id', '=', 'M.id')
        ->leftJoin('engineers as E3', 'PIO.tp_inward_engineer', '=', 'E3.id')
        ->leftJoin('engineers as E4', 'PIO.tp_outward_engineer', '=', 'E4.id')
        ->leftJoin('customer_departments as CD', 'PIO.department_id', '=', 'CD.id')
        ->get();
    }

    function createData($data)
    {

        $product = ProductInwardOutward::create($data);

        $count = ProductInwardOutward::count(); // total rows
        $product->product_io_no = 'GCS-PRODI-'.$count;
        $product->save();
        return $product;
    }

    function getDataById($uuid)
    {
        return ProductInwardOutward::where('uuid', $uuid)->first();
    }

    function updateData($uuid, $data)
    {
        return ProductInwardOutward::where('uuid', $uuid)->update($data);
    }

    function deleteData($uuid)
    {
        return ProductInwardOutward::where('uuid', $uuid)->delete();
    }
}
