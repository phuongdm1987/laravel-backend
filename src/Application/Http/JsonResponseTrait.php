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

    /**
     * @param array $data
     * @param int $errorCode
     * @return JsonResponse
     */
    public function error(array $data = [], $errorCode = 500): JsonResponse
    {
        return response()->json($data, $errorCode);
    }
}
