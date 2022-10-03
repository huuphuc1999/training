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
            return response()->json(
                [
                    'message' => 'errors',
                    "name" => "Somethings went wrong, try agian!",
                    "type" => "RESPONSE_FALSE",
                ], Response::HTTP_INTERNAL_SERVER_ERROR
            );
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
        return $request->all();
        // try {
        //     $this->userRepository->create($request->all());
        //     return response()->json(
        //         [
        //             'code' => 200,
        //             "name" => "New user added",
        //             "type" => "RESPONSE_OK",
        //             "message" => "success",
        //         ], Response::HTTP_OK
        //     );
        // } catch (\Throwable $th) {
        //     return response()->json(
        //         [
        //             'message' => 'errors',
        //             "name" => "Somethings went wrong, try agian!",
        //             "type" => "RESPONSE_FALSE",
        //         ], Response::HTTP_INTERNAL_SERVER_ERROR
        //     );
        // }

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
            return response()->json(
                [
                    'product' => $product,
                    'message' => 'success',
                    "name" => "Get user successfully",
                    "type" => "RESPONSE_OK",
                ], Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'message' => 'errors',
                    "name" => "Somethings went wrong, try agian!",
                    "type" => "RESPONSE_FALSE",
                ], Response::HTTP_INTERNAL_SERVER_ERROR
            );
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
            return response()->json(
                [
                    'message' => 'success',
                    "name" => "Delete product successfully",
                    "type" => "RESPONSE_OK",
                ], Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'message' => 'errors',
                    "name" => "Somethings went wrong, try agian!",
                    "type" => "RESPONSE_FALSE",
                ], Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

    }
}
