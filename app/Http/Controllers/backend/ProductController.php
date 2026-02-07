<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class ProductController extends Controller
{
    function __construct(protected ProductService $productService)
    {
    }

    function index()
    {

        $productList = $this->productService->index();
        $manufactureList = $this->productService->getManufacture();
        $productTypeList = $this->productService->getProductType();
        return view('backend/product/product-list', compact('productList', 'manufactureList', 'productTypeList'));
    }

    function create()
    {

        $manufactureList = $this->productService->getManufacture();
        $productTypeList = $this->productService->getProductType();
        return view('backend/product/add-product', compact('manufactureList', 'productTypeList'));
    }

    function store(Request $req)
    {

        $manufacture = $req->manufacture;
        $product_type = $req->product_type;
        $sub_product_type = $req->sub_product_type;
        $specification = $req->specification;
        $rate = $req->rate;
        $created_by = session('user_name', 'Guest');

        $data = ['manufacture' => $manufacture, 'product_type' => $product_type, 'sub_product_type' => $sub_product_type, 'specification' => $specification, 'rate' => $rate, 'created_by' => $created_by];
        $this->productService->store($data);

        return redirect()->route('admin.product.index');

    }

    function edit(Request $req, $uuid)
    {

        $uuid = $req->uuid;
        $products = $this->productService->edit($uuid);
        $product_type_id = $products->product_type;

        $manufactureList = $this->productService->getManufacture();
        $productTypeList = $this->productService->getProductType();
        $subProductTypeList = $this->productService->getSubProductType($product_type_id);

        return view('backend/product/edit-product', compact('products', 'manufactureList', 'productTypeList', 'subProductTypeList'));
    }

    function update(Request $req, $uuid)
    {

        $manufacture = $req->manufacture;
        $product_type = $req->product_type;
        $sub_product_type = $req->sub_product_type;
        $specification = $req->specification;
        $rate = $req->rate;
        $modified_by = session('user_name', 'Guest');

        $data = ['manufacture' => $manufacture, 'product_type' => $product_type, 'sub_product_type' => $sub_product_type, 'specification' => $specification, 'rate' => $rate, 'modified_by' => $modified_by];

        $update = $this->productService->update($uuid, $data);

        if ($update) {
            return redirect()->route('admin.product.index')->with('success', 'Update Success ...');
        } else {
            return redirect()->route('admin.product.index')->with('error', 'Not Update ...');
        }
    }

    function destroy($uuid)
    {

        $delete = $this->productService->destroy($uuid);

        if ($delete) {
            return redirect()->route('admin.product.index')->with('success', 'Delete Success ...');
        } else {
            return redirect()->route('admin.product.index')->with('error', 'Not Delete ...');
        }

    }


    function addManufacture(Request $request)
    {

        $manufacture = $request->manufacture;
        $created_by = session('user_name', 'Guest');
        $data = ['manufacture' => $manufacture, 'created_by' => $created_by];

        $this->productService->addManufacture($data);

        return redirect()->route('admin.product.index');

    }

    function addProductType(Request $request)
    {

        $product_type = $request->product_type;
        $sub_product_type = $request->sub_product_type;
        $created_by = session('user_name', 'Guest');
        $data = ['product_type' => $product_type, 'sub_product_type' => $sub_product_type, 'created_by' => $created_by];

        $this->productService->addProductType($data);

        return redirect()->route('admin.product.index');

    }


    public function getSubProductType(Request $request)
    {
        $productTypeID = $request->productTypeID;

        $subProductType = $this->productService->getSubProductType($productTypeID);

        return response()->json($subProductType);
    }
}
