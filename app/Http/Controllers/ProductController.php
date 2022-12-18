<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateValidation;
use App\Http\Requests\UpdateValidation;
use App\Models\Catalog;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $products = Product::orderBy('created_at')->take(5)->get();

        return view('pages.about', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $catalogs = Catalog::all();
        return view('admin.products.createOrUpdate', compact('catalogs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductCreateValidation $request)
    {
        $validate = $request->validated();
        unset($validate['photo']);
        # public/asd.jpg
        $photo = $request->file('photo')->store('public');
        # Explode => / => public/asd,jpg => ['public', 'asd.jpg']
        $validate['photo'] = explode('/', $photo)[1];
        Product::create($validate);
        return redirect()->route('catalog')->with(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Product $product)
    {
        return view('catalog.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Product $product, Request $request)
    {
        $catalogs = Catalog::all();
        $request->session()->flashInput($product->toArray());
        return view('admin.products.createOrUpdate', compact('product', 'catalogs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateValidation $request, Product $product)
    {
        $validate = $request->validated();
        unset($validate['photo']);
        if($request->hasFile('photo')) {
            # public/asd.jpg
            $photo = $request->file('photo')->store('public');
            # Explode => / => public/asd,jpg => ['public', 'asd.jpg']
            $validate['photo'] = explode('/', $photo)[1];
        }
        $product->update($validate);
        return redirect()->route('catalog')->with(['update' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('catalog')->with(['delete' => true]);
    }
}
