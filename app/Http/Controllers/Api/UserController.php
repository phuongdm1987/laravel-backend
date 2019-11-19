<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Jobs\Product\DeleteProductJob;
use App\Jobs\Product\StoreProductJob;
use App\Jobs\User\GetNormalUsersJob;
use App\Jobs\User\RegisterUserJob;
use App\Jobs\User\UpdateUserJob;
use Henry\Domain\Product\Product;
use Henry\Domain\User\User;
use Henry\Infrastructure\Product\Transformers\ProductTransformer;
use Henry\Infrastructure\Transformer;
use Henry\Infrastructure\User\Transformers\UserTransformer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class UserController
 * @package App\Http\Controllers\Api
 */
class UserController extends ApiController
{
    /**
     * @var Transformer
     */
    private $transformer;

    /**
     * ProductController constructor.
     * @param Transformer $transformer
     */
    public function __construct(Transformer $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        /** @var Collection $products */
        $users = GetNormalUsersJob::dispatchNow($request->all(), $request->get('per_page', 15));
        $users = $this->transformer->transform($users, new UserTransformer(), 'users');

        return $this->success($users);
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function store(RegisterRequest $request): JsonResponse
    {
        $user = $this->dispatchNow(RegisterUserJob::fromRequest($request));
        $result = $this->transformer->transform($user, new UserTransformer(), 'users');

        return $this->success($result, 'Store User Success');
    }

    /**
     * @param UpdateUserRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $this->dispatchNow(UpdateUserJob::fromRequest($request, $user));
        $result = $this->transformer->transform($user, new UserTransformer(), 'users');

        return $this->success($result, 'Update User Success');
    }

    /**
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        DeleteProductJob::dispatchNow($product);
        return $this->success(['msg' => 'Delete product success!']);
    }
}
