<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Services\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    function __construct(protected CustomerService $customerService)
    {
    }

    function index()
    {

        $customerList = $this->customerService->index();
        $stateList = $this->customerService->getState();
        $cityList = $this->customerService->getCity();
        $areaList = $this->customerService->getArea();
        return view('backend.customer.customer-list', compact('customerList', 'stateList', 'cityList', 'areaList'));
    }

    function create()
    {

        $areaList = $this->customerService->getArea();
        $coordinateList = $this->customerService->getCoordinateUser();
        $amcProductList = $this->customerService->getAmcProduct();

        return view('backend.customer.add-customer', compact('areaList', 'coordinateList', 'amcProductList'));
    }

    public function store(Request $req)
    {
        // Validation
        $validator = \Validator::make($req->all(), [
            'customer_name' => 'required',
            'mobile_no' => 'required|unique:customers,mobile_no',
            'email' => 'nullable|email|unique:customers,email',
        ]);

        if ($validator->fails()) {
            if ($req->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->first()
                ]);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $customer_name = $req->customer_name;
        $customer_type = $req->customer_type;
        $customer_category = $req->customer_category;
        $contact_person = $req->contact_person;
        $mobile_no = $req->mobile_no;
        $email = $req->email;
        $website = $req->website;

        // Missing fields from view
        $department = $req->department;
        $designation = $req->customer_designation; // Mapped from view input name

        $address_line_1 = $req->address_line_1;
        $address_line_2 = $req->address_line_2;

        $state_id = $req->state_id;
        $city_id = $req->city_id;
        $area_id = $req->area_id;
        $pincode = $req->pincode;

        $phone_1 = $req->phone_1;
        $phone_2 = $req->phone_2;

        $gst = $req->gst;
        $pan = $req->pan;
        $vat = $req->vat;
        $cst = $req->cst;

        $fax = $req->fax;
        $credit_days = $req->credit_days;
        $date_of_birth = $req->date_of_birth;
        $ac_key = $req->ac_key;
        $created_by = session('user_name', 'Guest');

        $lastCustomer = $this->customerService->getCustomerId();
        $nextId = $lastCustomer ? $lastCustomer->id + 1 : 1;
        $customer_code = 'GCS-' . $nextId;

        $data = [
            'customer_name' => $customer_name,
            'customer_type' => $customer_type,
            'customer_category' => $customer_category,
            'contact_person' => $contact_person,
            'customer_code' => $customer_code,
            'mobile_no' => $mobile_no,
            'email' => $email,
            'website' => $website,

            // Added missing fields
            // 'department' => $department,
            // 'designation' => $designation,

            'address_line_1' => $address_line_1,
            'address_line_2' => $address_line_2,

            'state_id' => $state_id,
            'city_id' => $city_id,
            'area_id' => $area_id,
            'pincode' => $pincode,

            'phone_1' => $phone_1,
            'phone_2' => $phone_2,

            'gst' => $gst,
            'pan' => $pan,
            'vat' => $vat,
            'cst' => $cst,

            'fax' => $fax,
            'credit_days' => $credit_days,
            'date_of_birth' => $date_of_birth,
            'ac_key' => $ac_key,
            'created_by' => $created_by
        ];

        $customer = $this->customerService->store($data);

        if ($req->wantsJson()) {
            return response()->json([
                'status' => true,
                'message' => 'Customer added successfully',
                'customer_id' => $customer->id,
                'uuid' => $customer->uuid ?? null
            ]);
        }

        return redirect()->route('admin.customer.index')->with('success', 'Customer added successfully');
    }

    function edit(Request $req, $uuid)
    {

        $uuid = $req->uuid;
        $customers = $this->customerService->edit($uuid);
        $area_id = $customers->area_id;
        $areaDetail = $this->customerService->getAreaById($area_id);
        $areaList = $this->customerService->getArea();
        $cityList = $this->customerService->getCityId($areaDetail->city_id);
        $stateList = $this->customerService->getStateId($areaDetail->state_id);
        $coordinateList = $this->customerService->getCoordinateUser();

        return view('backend/customer/edit-customer', compact('customers', 'stateList', 'cityList', 'areaList', 'coordinateList'));
    }

    function update(Request $req, $uuid)
    {

        $customer_name = $req->customer_name;
        $customer_type = $req->customer_type;
        $customer_category = $req->customer_category;
        $contact_person = $req->contact_person;
        $mobile_no = $req->mobile_no;
        $email = $req->email;
        $website = $req->website;
        $address_line_1 = $req->address_line_1;
        $address_line_2 = $req->address_line_2;
        $state_id = $req->state_id;
        $city_id = $req->city_id;
        $area_id = $req->area_id;
        $pincode = $req->pincode;
        $phone_1 = $req->phone_1;
        $phone_2 = $req->phone_2;
        $gst = $req->gst;
        $pan = $req->pan;
        $vat = $req->vat;
        $cst = $req->cst;
        $fax = $req->fax;
        $credit_days = $req->credit_days;
        $date_of_birth = $req->date_of_birth;
        $ac_key = $req->ac_key;
        $modified_by = session('user_name', 'Guest');

        $data = [
            'customer_name' => $customer_name,
            'customer_type' => $customer_type,
            'customer_category' => $customer_category,
            'contact_person' => $contact_person,
            'mobile_no' => $mobile_no,
            'email' => $email,
            'website' => $website,
            'address_line_1' => $address_line_1,
            'address_line_2' => $address_line_2,
            'state_id' => $state_id,
            'city_id' => $city_id,
            'area_id' => $area_id,
            'pincode' => $pincode,
            'phone_1' => $phone_1,
            'phone_2' => $phone_2,
            'gst' => $gst,
            'pan' => $pan,
            'vat' => $vat,
            'cst' => $cst,
            'fax' => $fax,
            'credit_days' => $credit_days,
            'date_of_birth' => $date_of_birth,
            'ac_key' => $ac_key,
            'modified_by' => $modified_by
        ];

        $update = $this->customerService->update($uuid, $data);

        if ($update) {
            return redirect()->route('admin.customer.index')->with('success', 'Update Success ...');
        } else {
            return redirect()->route('admin.customer.index')->with('error', 'Not Update ...');
        }
    }


    function destroy($uuid)
    {

        $delete = $this->customerService->destroy($uuid);

        if ($delete) {
            return redirect()->route('admin.customer.index')->with('success', 'Delete Success ...');
        } else {
            return redirect()->route('admin.customer.index')->with('error', 'Not Delete ...');
        }
    }

    public function getCustomerBranch(Request $request)
    {
        $branches = $this->customerService->getCustomerBranch($request->customer_id);

        return response()->json($branches);
    }


    public function addCustomerBranch(Request $req)
    {

        $customer_uuid = $req->customer_uuid;
        $customer_id = $req->customer_id;
        $branch_name = $req->branch_name;
        $contact_person = $req->contact_person;
        $mobile_no = $req->mobile_no;
        $customer_code = $req->customer_code;
        $email = $req->email;
        $phone = $req->phone;
        $address_line_1 = $req->address_line_1;
        $address_line_2 = $req->address_line_2;
        $state_id = $req->state_id;
        $city_id = $req->city_id;
        $area_id = $req->area_id;
        $pincode = $req->pincode;
        $fax = $req->fax;
        $created_by = session('user_name', 'Guest');

        $data = [
            'customer_id' => $customer_id,
            'branch_name' => $branch_name,
            'contact_person' => $contact_person,
            'mobile_no' => $mobile_no,
            'customer_code' => $customer_code,
            'email' => $email,
            'phone' => $phone,
            'address_line_1' => $address_line_1,
            'address_line_2' => $address_line_2,
            'state_id' => $state_id,
            'city_id' => $city_id,
            'area_id' => $area_id,
            'pincode' => $pincode,
            'fax' => $fax,
            'created_by' => $created_by
        ];

        $branch = $this->customerService->addCustomerBranch($data);

        if ($req->wantsJson()) {
            return response()->json([
                'status' => true,
                'message' => 'Branch added successfully',
                'branch_id' => $branch->id
            ]);
        }

        return redirect()->route('admin.customer.index');
    }

    function editCustomerBranch(Request $req)
    {

        $id = $req->branch_id;
        $branch_name = $req->branch_name;
        $contact_person = $req->contact_person;
        $mobile_no = $req->mobile_no;
        $customer_code = $req->customer_code;
        $email = $req->email;
        $phone = $req->phone;
        $address_line_1 = $req->address_line_1;
        $address_line_2 = $req->address_line_2;
        $state_id = $req->state_id;
        $city_id = $req->city_id;
        $area_id = $req->area_id;
        $pincode = $req->pincode;
        $fax = $req->fax;
        $modified_by = session('user_name', 'Guest');

        $data = [
            'branch_name' => $branch_name,
            'contact_person' => $contact_person,
            'mobile_no' => $mobile_no,
            'customer_code' => $customer_code,
            'email' => $email,
            'phone' => $phone,
            'address_line_1' => $address_line_1,
            'address_line_2' => $address_line_2,
            'state_id' => $state_id,
            'city_id' => $city_id,
            'area_id' => $area_id,
            'pincode' => $pincode,
            'fax' => $fax,
            'modified_by' => $modified_by
        ];

        $update = $this->customerService->editCustomerBranch($id, $data);

        if ($update) {
            return redirect()->route('admin.customer.index')->with('success', 'Update Success ...');
        } else {
            return redirect()->route('admin.customer.index')->with('error', 'Not Update ...');
        }
    }


    public function getStateCities(Request $request)
    {
        $state_id = $request->stateID;

        $cities = $this->customerService->getStateCity($state_id);

        return response()->json($cities);
    }

    public function getCityArea(Request $request)
    {
        $city_id = $request->cityID;

        $areas = $this->customerService->getCityArea($city_id);

        return response()->json($areas);
    }

    public function getAreaCities(Request $request)
    {
        $area_id = $request->areaID;

        $area = $this->customerService->getAreaById($area_id);

        if (!$area) {
            return response()->json(['status' => false]);
        }

        $city = $this->customerService->getCityId($area->city_id);
        $state = $this->customerService->getStateId($area->state_id);

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


    function CustomerAmcProduct(Request $request, $uuid)
    {

        $customerBranch = $this->customerService->getCustomerBranchByUuid($uuid);
        $branch_id = $customerBranch->id;
        $customer_id = $customerBranch->customer_id;

        $customer = $this->customerService->getCustomerById($customer_id);

        $amcProductList = $this->customerService->getAmcProduct();
        // $amcProductList = $this->customerService->getAmcCount($customer_id,$branch_id);

        return view('backend.customer.amc-product-list', compact('amcProductList', 'customerBranch', 'customer'));
    }


    function getCustomerAmcProduct(Request $request, $customer_id, $branch_id, $amc_product_id)
    {

        $customer = $this->customerService->getCustomerById($customer_id);
        $customerBranch = $this->customerService->getBranchById($branch_id);
        $amcProduct = $this->customerService->getAmcProductById($amc_product_id);
        $amcProduct = $this->customerService->getAmcProductById($amc_product_id);
        $getEngineer = $this->customerService->getEngineer();

        $amcProductList = $this->customerService->getCustomerProduct($customer_id, $branch_id, $amc_product_id);

        return view('backend.customer.customer-amc-product-list', compact('amcProductList', 'customer', 'customerBranch', 'amcProduct', 'getEngineer'));
    }


    public function addCustomerAmcProduct(Request $request)
    {
        // Collect form inputs
        $customer_id = $request->customer_id;
        $branch_id = $request->branch_id;
        $amc_product_id = $request->amc_product_id;
        $product_type = $request->product_type;
        $product_category = $request->product_category;
        $department = $request->department;
        $user_name = $request->user_name;
        $description = $request->description;
        $quantity = $request->quantity;
        $created_by = session('user_name', 'Guest');

        // Convert dates from "d M Y" (Flatpickr) to "Y-m-d" (MySQL)
        $amc_start_date = $request->amc_start_date ? date('Y-m-d', strtotime($request->amc_start_date)) : null;
        $amc_end_date = $request->amc_end_date ? date('Y-m-d', strtotime($request->amc_end_date)) : null;
        $service_date_1 = $request->service_date_1 ? date('Y-m-d', strtotime($request->service_date_1)) : null;
        $service_date_2 = $request->service_date_2 ? date('Y-m-d', strtotime($request->service_date_2)) : null;
        $service_date_3 = $request->service_date_3 ? date('Y-m-d', strtotime($request->service_date_3)) : null;

        // Service engineers
        $service_engineer_1 = $request->service_engineer_1;
        $service_engineer_2 = $request->service_engineer_2;
        $service_engineer_3 = $request->service_engineer_3;

        // Prepare data array
        $data = [
            'customer_id' => $customer_id,
            'branch_id' => $branch_id,
            'amc_product_id' => $amc_product_id,
            'product_type' => $product_type,
            'product_category' => $product_category,
            'department' => $department,
            'user_name' => $user_name,
            'description' => $description,
            'amc_start_date' => $amc_start_date,
            'amc_end_date' => $amc_end_date,
            'service_date_1' => $service_date_1,
            'service_engineer_1' => $service_engineer_1,
            'service_date_2' => $service_date_2,
            'service_engineer_2' => $service_engineer_2,
            'service_date_3' => $service_date_3,
            'service_engineer_3' => $service_engineer_3,
            'quantity' => $quantity,
            'created_by' => $created_by,
        ];

        // Call your service to save
        $product = $this->customerService->addCustomerProduct($data);

        if ($request->wantsJson()) {
            return response()->json([
                'status' => true,
                'message' => 'Product added successfully',
                'product_id' => $product->id
            ]);
        }

        return redirect()->route(
            'admin.customer.amc.product.list',
            [
                'customer_id' => $customer_id,
                'branch_id' => $branch_id,
                'amc_product_id' => $amc_product_id
            ]
        )->with('success', 'Product added successfully');
    }


    function editCustomerAmcProduct(Request $request)
    {

        $id = $request->id;
        $customer_id = $request->customer_id;
        $branch_id = $request->branch_id;
        $amc_product_id = $request->amc_product_id;
        $product_type = $request->product_type;
        $product_category = $request->product_category;
        $department = $request->department;
        $user_name = $request->user_name;
        $description = $request->description;
        $quantity = $request->quantity;
        $modified_by = session('user_name', 'Guest');

        // Convert dates from "d M Y" (Flatpickr) to "Y-m-d" (MySQL)
        $amc_start_date = $request->amc_start_date ? date('Y-m-d', strtotime($request->amc_start_date)) : null;
        $amc_end_date = $request->amc_end_date ? date('Y-m-d', strtotime($request->amc_end_date)) : null;
        $service_date_1 = $request->service_date_1 ? date('Y-m-d', strtotime($request->service_date_1)) : null;
        $service_date_2 = $request->service_date_2 ? date('Y-m-d', strtotime($request->service_date_2)) : null;
        $service_date_3 = $request->service_date_3 ? date('Y-m-d', strtotime($request->service_date_3)) : null;

        // Service engineers
        $service_engineer_1 = $request->service_engineer_1;
        $service_engineer_2 = $request->service_engineer_2;
        $service_engineer_3 = $request->service_engineer_3;

        // Prepare data array
        $data = [
            'product_type' => $product_type,
            'product_category' => $product_category,
            'department' => $department,
            'user_name' => $user_name,
            'description' => $description,
            'amc_start_date' => $amc_start_date,
            'amc_end_date' => $amc_end_date,
            'service_date_1' => $service_date_1,
            'service_engineer_1' => $service_engineer_1,
            'service_date_2' => $service_date_2,
            'service_engineer_2' => $service_engineer_2,
            'service_date_3' => $service_date_3,
            'service_engineer_3' => $service_engineer_3,
            'quantity' => $quantity,
            'modified_by' => $modified_by,
        ];

        $update = $this->customerService->editCustomerProduct($id, $data);

        if ($update) {
            return redirect()->route(
                'admin.customer.amc.product.list',
                [
                    'customer_id' => $customer_id,
                    'branch_id' => $branch_id,
                    'amc_product_id' => $amc_product_id
                ]
            )->with('success', 'Product update successfully');
        } else {
            return redirect()->route(
                'admin.customer.amc.product.list',
                [
                    'customer_id' => $customer_id,
                    'branch_id' => $branch_id,
                    'amc_product_id' => $amc_product_id
                ]
            )->with('success', 'Product not update');
        }
    }


    function DeleteCustomerAmcProduct($uuid)
    {

        $productDetails = $this->customerService->customerProductById($uuid);
        $customer_id = $productDetails->customer_id;
        $branch_id = $productDetails->branch_id;
        $amc_product_id = $productDetails->amc_product_id;

        $delete = $this->customerService->deleteCustomerProduct($uuid);

        if ($delete) {
            return redirect()->route(
                'admin.customer.amc.product.list',
                [
                    'customer_id' => $customer_id,
                    'branch_id' => $branch_id,
                    'amc_product_id' => $amc_product_id
                ]
            )->with('success', 'Product not update');
        } else {
            return redirect()->route(
                'admin.customer.amc.product.list',
                [
                    'customer_id' => $customer_id,
                    'branch_id' => $branch_id,
                    'amc_product_id' => $amc_product_id
                ]
            )->with('success', 'Product not update');
        }
    }


    public function getCustomerContact(Request $request)
    {
        $customers = $this->customerService->getCustomerContact($request->customer_id);

        return response()->json($customers);
    }


    public function addCustomerContact(Request $req)
    {

        $customer_uuid = $req->customer_uuid;
        $customer_id = $req->customer_id;
        $branch_id = $req->branch_id;
        $contact_name = $req->contact_name;
        $department = $req->department;
        $designation = $req->designation;
        $mobile_no = $req->mobile_no;
        $email_id = $req->email_id;
        $date_of_birth = $req->date_of_birth;
        $created_by = session('user_name', 'Guest');

        $data = [
            'customer_id' => $customer_id,
            'branch_id' => $branch_id,
            'contact_name' => $contact_name,
            'department' => $department,
            'designation' => $designation,
            'mobile_no' => $mobile_no,
            'email_id' => $email_id,
            'date_of_birth' => $date_of_birth,
            'created_by' => $created_by
        ];

        $contact = $this->customerService->addCustomerContact($data);

        if ($req->wantsJson()) {
            return response()->json([
                'status' => true,
                'message' => 'Contact added successfully',
                'contact_id' => $contact->id
            ]);
        }

        return redirect()->route('admin.customer.index');
    }

    function editCustomerContact(Request $req)
    {

        $id = $req->id;
        $contact_name = $req->contact_name;
        $department = $req->department;
        $designation = $req->designation;
        $mobile_no = $req->mobile_no;
        $email_id = $req->email_id;
        $date_of_birth = $req->date_of_birth;
        $modified_by = session('user_name', 'Guest');
        $branch_id = $req->branch_id; // Added this line

        $data = [
            'branch_id' => $branch_id, // Modified this line
            'contact_name' => $contact_name,
            'department' => $department,
            'designation' => $designation,
            'mobile_no' => $mobile_no,
            'email_id' => $email_id,
            'date_of_birth' => $date_of_birth,
            'modified_by' => $modified_by
        ];


        $this->customerService->editCustomerContact($id, $data);

        return redirect()->route('admin.customer.index');
    }

    function CustomerBranchContact(Request $request, $uuid)
    {
        $customerBranch = $this->customerService->getCustomerBranchByUuid($uuid);
        $customer_id = $customerBranch->customer_id;
        $branch_id = $customerBranch->id;
        $customer = $this->customerService->getCustomerById($customer_id);
        $customerBranchContact = $this->customerService->getCustomerBranchContact($customer_id, $branch_id);

        return view('backend.customer.customer-branch-contact-list', compact('customer', 'customerBranch', 'customerBranchContact'));

    }

    function addCustomerBranchContact(Request $request)
    {

        $uuid = $request->uuid;
        $customer_id = $request->customer_id;
        $branch_id = $request->branch_id;
        $contact_name = $request->contact_name;
        $mobile_no = $request->mobile_no;
        $email_id = $request->email_id;
        $designation = $request->designation;
        $created_by = session('user_name', 'Guest');

        $data = [
            'customer_id' => $customer_id,
            'branch_id' => $branch_id,
            'contact_name' => $contact_name,
            'mobile_no' => $mobile_no,
            'email_id' => $email_id,
            'designation' => $designation,
            'created_by' => $created_by
        ];

        $this->customerService->addCustomerBranchContact($data);

        return redirect()->route('admin.customer.branch.contact', ['uuid' => $uuid]);

    }

    // AJAX Product Methods
    public function getProducts(Request $request)
    {
        $products = $this->customerService->getAllCustomerProducts($request->customer_id);
        return response()->json(['status' => true, 'data' => $products]);
    }

    public function addProduct(Request $request)
    {
        $data = $request->except('_token', 'id');
        $data['created_by'] = session('user_name', 'Guest');

        // Date formatting if needed (basic check)
        $dateFields = ['amc_start_date', 'amc_end_date', 'service_date_1', 'service_date_2', 'service_date_3'];
        foreach ($dateFields as $field) {
            if (isset($data[$field]) && !empty($data[$field])) {
                $data[$field] = date('Y-m-d', strtotime($data[$field]));
            } else {
                $data[$field] = null;
            }
        }

        $create = $this->customerService->addCustomerProduct($data);
        return response()->json(['status' => (bool) $create, 'message' => $create ? 'Product added successfully' : 'Failed to add product']);
    }

    public function editProduct(Request $request)
    {
        $id = $request->id;
        $data = $request->except('_token', 'id', 'customer_id', 'created_at', 'updated_at', 'uuid'); // Exclude safe fields
        $data['modified_by'] = session('user_name', 'Guest');

        // Date formatting
        $dateFields = ['amc_start_date', 'amc_end_date', 'service_date_1', 'service_date_2', 'service_date_3'];
        foreach ($dateFields as $field) {
            if (isset($data[$field]) && !empty($data[$field])) {
                $data[$field] = date('Y-m-d', strtotime($data[$field]));
            } else {
                // Use array_key_exists to avoid overwriting existing nulls if key is missing? 
                // Usually form sends empty string for cleared dates.
                $data[$field] = null;
            }
        }

        $update = $this->customerService->editCustomerProduct($id, $data);
        return response()->json(['status' => (bool) $update, 'message' => $update ? 'Product updated successfully' : 'Failed to update product']);
    }

    public function deleteProduct(Request $request)
    {
        $delete = $this->customerService->deleteCustomerProduct($request->uuid);
        return response()->json(['status' => (bool) $delete, 'message' => $delete ? 'Product deleted successfully' : 'Failed to delete product']);
    }
}
