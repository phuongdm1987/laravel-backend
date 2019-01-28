<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Henry\Domain\Category\ValueObjects\Type;
use Henry\Domain\Product\Repositories\ProductRepositoryInterface;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * Create a new controller instance.
     *
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->middleware(['auth', 'verified']);
        $this->productRepository = $productRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return Renderable
     */
    public function index(Request $request): Renderable
    {
        $products = $this->productRepository->withPaginate($request->all());
        return view('home', compact('products'));
    }
}
