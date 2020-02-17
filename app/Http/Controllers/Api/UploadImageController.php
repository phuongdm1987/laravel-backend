<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\UploadImageRequest;
use App\Jobs\Image\DestroyImageJob;
use App\Jobs\Image\UploadImageJob;
use Illuminate\Http\JsonResponse;

/**
 * Class UploadImageController
 * @package App\Http\Controllers\Api
 */
class UploadImageController extends ApiController
{
    /**
     * Store a newly created resource in storage.
     * @param UploadImageRequest $request
     * @return JsonResponse
     */
    public function store(UploadImageRequest $request): JsonResponse
    {
        $path = $this->dispatchNow(UploadImageJob::fromRequest($request));

        return $this->success(['path' => $path], 'Upload Image Success');
    }

    /**
     * Remove the specified resource from storage.
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        $this->dispatchNow(new DestroyImageJob($id));

        return $this->success(['path' => $id], 'Destroy Image Success');
    }
}
