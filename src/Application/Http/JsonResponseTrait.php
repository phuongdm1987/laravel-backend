<?php
declare(strict_types=1);

namespace Henry\Application\Http;

use Illuminate\Http\JsonResponse;

/**
 * Trait JsonResponseTrait
 * @package Henry\Application\Http
 */
trait JsonResponseTrait
{
    /**
     * @param array $data
     * @return JsonResponse
     */
    public function createSuccess(array $data = []): JsonResponse
    {
        return response()->json($data, 201);
    }

    /**
     * @param array $data
     * @return JsonResponse
     */
    public function success(array $data = []): JsonResponse
    {
        return response()->json($data);
    }
}
