<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Henry\Domain\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

/**
 * Class ProductController
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @param Product $product
     * @return View
     */
    public function show(Product $product): View
    {
        $productUsers = $product->users()->take(20)->get();
        return view('product.show', compact('product', 'productUsers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Henry\Domain\Product\Product $product
     * @return Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Henry\Domain\Product\Product $product
     * @return Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Henry\Domain\Product\Product $product
     * @return Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
