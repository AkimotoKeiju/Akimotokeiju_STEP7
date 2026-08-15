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
        $products = $productModel->getListWithSearch($searchName, $searchCompany);
        $companies = Company::all();

        return view('products.index', compact('products', 'companies'));
    }

    /**
     * 新規登録画面を表示
     */
    public function create()
    {
        $companies = Company::all();
        return view('products.create', compact('companies'));
    }

    /**
     * 新規登録処理
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        // 画像の保存処理
        if ($request->hasFile('img_path')) {
            $filename = $request->file('img_path')->getClientOriginalName();
            $path = $request->file('img_path')->storeAs('products', $filename, 'public');
            $data['img_path'] = $path;
        }

        Product::create($data);

        // 仕様書指示：登録完了後は新規登録画面へリダイレクト
        return redirect()->route('products.create')->with('success', '商品を登録しました');
    }

    /**
     * 詳細画面を表示
     */
    public function show($id)
    {
        $product = Product::with('company')->findOrFail($id);
        return view('products.show', compact('product'));
    }

    /**
     * 編集画面を表示
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $companies = Company::all();

        return view('products.edit', compact('product', 'companies'));
    }

    /**
     * 更新処理
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->validated();

        // 画像の更新処理
        if ($request->hasFile('img_path')) {
            // 古い画像を削除
            if ($product->img_path && Storage::disk('public')->exists($product->img_path)) {
                Storage::disk('public')->delete($product->img_path);
            }

            $filename = $request->file('img_path')->getClientOriginalName();
            $path = $request->file('img_path')->storeAs('products', $filename, 'public');
            $data['img_path'] = $path;
        }

        $product->update($data);

        // 仕様書指示：更新完了後は編集画面へリダイレクト
        return redirect()->route('products.edit', $product->id)->with('success', '商品情報を更新しました');
    }

    /**
     * 削除処理
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // 画像ファイルの削除
        if ($product->img_path && Storage::disk('public')->exists($product->img_path)) {
            Storage::disk('public')->delete($product->img_path);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', '商品を削除しました');
    }
}