<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * 商品一覧画面
     */
    public function index(Request $request)
    {
        $searchName = $request->input('search_name');
        $searchCompany = $request->input('search_company');

        $productModel = new Product();
        $companyModel = new Company();

        $products = $productModel->getListWithSearch($searchName, $searchCompany);
        $companies = $companyModel->getCompanyList();

        return view('products.index', compact('products', 'companies'));
    }

    /**
     * 新規登録画面を表示
     */
    public function create()
    {
        $companyModel = new Company();
        $companies = $companyModel->getCompanyList();

        return view('products.create', compact('companies'));
    }

    /**
     * 新規登録処理
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('img_path')) {
            $data['img_path'] = $request->file('img_path')->store('products', 'public');
        }

        $productModel = new Product();
        $productModel->registProduct($data);

        return redirect()->route('products.index')->with('success', '商品を登録しました');
    }

    /**
     * 詳細画面を表示
     */
    public function show($id)
    {
        $productModel = new Product();
        $product = $productModel->getDetail($id);

        return view('products.show', compact('product'));
    }

    /**
     * 編集画面を表示
     */
    public function edit($id)
    {
        $productModel = new Product();
        $companyModel = new Company();

        $product = $productModel->getDetail($id);
        $companies = $companyModel->getCompanyList();

        return view('products.edit', compact('product', 'companies'));
    }

    /**
     * 更新処理
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();

        if ($request->hasFile('img_path')) {
            $data['img_path'] = $request->file('img_path')->store('products', 'public');
        } else {
            unset($data['img_path']);
        }

        $product->updateProduct($data);

        return redirect()->route('products.index')->with('success', '商品を更新しました');
    }

    /**
     * 削除処理
     */
    public function destroy($id)
    {
        $productModel = new Product();
        $product = $productModel->getDetail($id);

        if ($product->img_path && Storage::disk('public')->exists($product->img_path)) {
            Storage::disk('public')->delete($product->img_path);
        }

        $product->deleteProduct();

        return redirect()->route('products.index')->with('success', '商品を削除しました');
    }
}