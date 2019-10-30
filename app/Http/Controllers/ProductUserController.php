<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductUserRequest;
use App\Jobs\ProductUser\StoreProductUser;
use Henry\Domain\Product\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

/**
 * Class ProductUserController
 * @package App\Http\Controllers
 */
class ProductUserController extends Controller
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
     * @param StoreProductUserRequest $request
     * @return RedirectResponse
     */
    public function store(StoreProductUserRequest $request): RedirectResponse
    {
        $productUser = $this->dispatchNow(StoreProductUser::fromRequest($request));

        return redirect()->route('products.show', $productUser->product->getSlug());
    }

    /**
     * @param Product $product
     * @return View
     */
    public function show(Product $product): View
    {
        return view('product.show', compact('product'));
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
