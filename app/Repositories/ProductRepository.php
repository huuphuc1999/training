<?php
/**
 * Product repository
 *
 * PHP version 7
 *
 * @category  Repository
 * @package   App
 * @author    Phuc <phan.phuc.rcvn2012@gmail.com>
 * @copyright 2016 CriverCrane! Corporation. All Rights Reserved.
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      http://localhost/
 */
namespace App\Repositories;

use Yajra\Datatables\Datatables;

/**
 * A template for common problems
 *
 * @category  Repository
 * @package   App
 * @author    Phuc <phan.phuc.rcvn2012@gmail.com>
 * @copyright 2016 CriverCrane! Corporation. All Rights Reserved.
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      http://localhost/
 */
class ProductRepository extends EloquentRepository
{
    /**
     * EloquentRepository constructor.
     */
    // public function __construct()
    // {
    //     $this->now = Carbon::now('Asia/Ho_Chi_Minh');
    // }
    /**
     * Get model
     *
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Product::class;
    }
    /**
     * Show product details
     *
     * @param $id product for find specified product

     * @return mixed
     */
    public function getProductDetails($id)
    {
        return $this->model::where('product_id', $id)->first();
    }
    /**
     * Delete product
     *
     * @param $id product for find specified product

     * @return mixed
     */
    public function deleteProduct($id)
    {
        return $this->model::where('product_id', $id)->delete();
    }
    /**
     * Store product
     *
     * @param \Illuminate\Http\Request $request submitted by users

     * @return mixed
     */
    public function addProduct($request)
    {
        $data = $request->all();

        $data['product_id'] = $request->product_name[0] . floor(time() - 999999999);
        if ($request->product_image) {
            $filename = $request->product_image->getClientOriginalName();
            $path = $request->file('product_image')->storeAs('public/backend/images/products', $filename);
            $data['product_image'] = 'backend/images/products/' . $filename;
        }
        return $this->model::create($data);
    }
    /**
     * Update product
     *
     * @param $id      product for find specified product
     * @param \Illuminate\Http\Request $request submitted by users

     * @return mixed
     */
    public function updateProduct($id, $request)
    {
        $data = $request->all();
        if ($request->product_image) {
            $filename = $request->product_image->getClientOriginalName();
            $path = $request->file('product_image')->storeAs('public/backend/images/products', $filename);
            $data['product_image'] = 'backend/images/products/' . $filename;
        }

        return $this->model::where('product_id', $id)->update($data);
    }
    /**
     * Handle user searching data.
     *
     * @param \Illuminate\Http\Request $request submitted by users

     * @return mixed
     */
    public function productSearching($request)
    {
        if (request()->ajax()) {
            $querySearch = \App\Models\Product::query();
            if ($request->load == 'index') {
                $results = $querySearch
                    ->latest()
                    ->get();
            }
            if ($request->load == 'search') {
                if ($request->filled('productStatus')) {
                    $querySearch->where('is_sales', $request->productStatus);
                }
                if ($request->productName) {
                    $querySearch->where('product_name', 'like', '%' . $request->productName . '%');
                }
                if ($request->productPriceFrom && $request->productPriceTo) {
                    $querySearch->whereBetween('product_price', [$request->productPriceFrom, $request->productPriceTo])->orderBy('product_price');
                }
                if ($request->productPriceFrom) {
                    $querySearch->where('product_price', '>=', $request->productPriceFrom)->orderBy('product_price');
                }
                if ($request->productPriceTo) {
                    $querySearch->where('product_price', '<=', $request->productPriceTo)->orderBy('product_price');
                }
                $results = $querySearch;
            }

            return Datatables::of($results)
                ->addIndexColumn()
                ->addColumn(
                    'action',
                    function ($results) {
                        $btn = '<button class="popupEditProduct" data-toggle="modal" data-target=".popupProduct" data-id=' . $results->product_id . '  type="button" id="' . 'popupEditProduct' . $results->product_id . '"><i class="fa fa-edit"></i></button>';
                        $btn = $btn . ' <button class="removeProductButton"  data-id=' . $results->product_id . ' type="button" id="' . 'removeProductID-' . $results->product_id . '"><i class="fa fa-remove"></i></button>';
                        return $btn;
                    }
                )
                ->editColumn(
                    'product_price',
                    function ($results) {
                        return ('$ ' . $results->product_price);
                    }
                )
                ->editColumn(
                    'is_sales',
                    function ($results) {
                        $results->is_sales === 1 ? $status = 'Đang bán' : $status = 'Ngừng bán';
                        return $status;
                    }
                )
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
