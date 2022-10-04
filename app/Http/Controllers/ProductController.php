<?php
/**
 * Product controller
 *
 * PHP version 7
 *
 * @category  Controllers
 * @package   App
 * @author    Phuc <phan.phuc.rcvn2012@gmail.com>
 * @copyright 2016 CriverCrane! Corporation. All Rights Reserved.
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      http://localhost/
 */
namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Handle CRUD User
 *
 * @category  Controllers
 * @package   App
 * @author    Phuc <phan.phuc.rcvn2012@gmail.com>
 * @copyright 2016 CriverCrane! Corporation. All Rights Reserved.
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      http://localhost/
 */
class ProductController extends Controller
{
    /**
     * Inject user Repository to construct
     */
    protected $productRepository;
    /**
     * Create a new controller instance.
     *
     * @param $productRepository use for query
     *
     * @return void
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    /**
     * Show all users that are not deleted .
     *
     * @param \Illuminate\Http\Request $request submitted by users
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                return $this->productRepository->productSearching($request);
            }
            return view('backend.user.index');
        } catch (\Throwable $th) {
            return $this->errorsResponce($message = 'Somethings went wrong, try agian!'); //phpcs:ignore
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request submitted by users
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AddProductRequest $request)
    {
        try {
            $this->productRepository->addProduct($request);
            return $this->successResponce($message = 'New product added');

        } catch (\Throwable $th) {
            return $this->errorsResponce($message = 'Somethings went wrong, try agian!'); //phpcs:ignore
        }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request submitted by users
     * @param int                      $id      product
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AddProductRequest $request, $id)
    {
        try {
            $this->productRepository->updateProduct($id, $request);
            return $this->successResponce($message = 'Update product successfully');
        } catch (\Throwable $th) {
            return $this->errorsResponce($message = 'Somethings went wrong, try agian!'); //phpcs:ignore
        }

    }
    /**
     * Display the specified resource.
     *
     * @param int $id product
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $product = $this->productRepository->getProductDetails($id);
            return $this->successResponce($product, $message = 'Get product details successfully'); //phpcs:ignore
        } catch (\Throwable $th) {
            return $this->errorsResponce($message = 'Somethings went wrong, try agian!'); //phpcs:ignore
        }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id product to delete the product
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->productRepository->deleteProduct($id);
            return $this->successResponce($message = 'Delete product successfully');
        } catch (\Throwable $th) {
            return $this->errorsResponce($message = 'Somethings went wrong, try agian!'); //phpcs:ignore
        }

    }
}
