<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\UploadImageRequest;
use App\Jobs\Image\UploadImageJob;
use Illuminate\Http\Request;

/**
 * Class UploadImageController
 * @package App\Http\Controllers\Api
 */
class UploadImageController extends ApiController
{
    /**
     * Store a newly created resource in storage.
     * @param UploadImageRequest $request
     * @return void
     */
    public function store(UploadImageRequest $request)
    {
        $product = $this->dispatchNow(UploadImageJob::fromRequest($request));
//        $result = $this->transformer->transform($product, new ProductTransformer(), 'products');
//
//        return $this->success($result, 'Store Product Success');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
