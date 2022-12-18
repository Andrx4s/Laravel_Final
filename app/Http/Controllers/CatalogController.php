<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCatalogValidation;
use App\Models\Catalog;
use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $categories = Catalog::all();

        return view('admin.catalog.catalogAll', compact( 'categories'));
    }

    public function catalog()
    {
        $products = Product::orderBy('created_at')->simplePaginate(10);
        $categories = Catalog::all();

        return view('catalog.catalog', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.catalog.createOrUpdate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateCatalogValidation $request)
    {
        $validate = $request->validated();
        Catalog::create($validate);
        return redirect()->route('admin.catalog.index');
    }

    /**
     * @param Catalog $catalog
     * @return void
     */
    public function show(Catalog $catalog)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Catalog $catalog, Request $request)
    {
        $request->session()->flashInput($catalog->toArray());
        return view('admin.catalog.createOrUpdate', compact('catalog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CreateCatalogValidation $request, Catalog $catalog)
    {
        $validate = $request->validated();
        $catalog->update($validate);
        return redirect()->route('admin.catalog.index')->with(['update' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Catalog $catalog)
    {
        $catalog->delete();
        return redirect()->back()->with(['delete' => true]);
    }
}
