<?php

namespace App\Repository;

use App\Models\CustomerComplaint;

class CustomerComplaintRepository
{


    function getAllData()
    {
        return CustomerComplaint::select('customer_complaints.*', 'customers.company_name as company', 'engineers.name as engineer', 'amc_products.amc_product as product_name','customer_branches.branch_name as branch','customer_departments.department')
            ->leftjoin('customers', 'customer_complaints.company_id', '=', 'customers.id')
            ->leftjoin('amc_products', 'customer_complaints.product_id', '=', 'amc_products.id')
            ->leftJoin('engineers', 'customer_complaints.engineer_id', '=', 'engineers.id')
            ->leftJoin('customer_branches', 'customer_complaints.branch_id', '=', 'customer_branches.id')
            ->leftJoin('customer_departments', 'customer_complaints.department_id', '=', 'customer_departments.id')
            ->get();
    }

    function createData($data)
    {
        $complaint = CustomerComplaint::create($data);

        $count = CustomerComplaint::count(); // total rows
        $complaint->complaint_no = 'GCS-' . $count;
        $complaint->save();

        return $complaint;
    }

    function getDataById($uuid)
    {
        return CustomerComplaint::where('uuid', $uuid)->first();
    }

    function updateData($uuid, $data)
    {
        return CustomerComplaint::where('uuid', $uuid)->update($data);
    }

    function deleteData($uuid)
    {
        return CustomerComplaint::where('uuid', $uuid)->delete();
    }
}
