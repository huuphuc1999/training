<?php
/**
 * Custommer repository
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

use App\Repositories\EloquentRepository;
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
class CustomerRepository extends EloquentRepository
{
    /**
     * Get model
     *
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Customer::class;
    }
    /**
     * Show product details
     *
     * @param $id product for find specified product

     * @return mixed
     */
    public function getCustomerDetails($id)
    {
        return $this->model::where('customer_id', $id)->first();
    }
    /**
     * Handle user searching data.
     *
     * @param \Illuminate\Http\Request $request submitted by users

     * @return mixed
     */
    public function customerSearching($request)
    {
        if (request()->ajax()) {
            $querySearch = \App\Models\Customer::query();
            if ($request->load == 'index') {
                $results = $querySearch
                    ->orderBy('customer_id', 'DESC')
                    ->get();
            }
            if ($request->load == 'search') {
                if ($request->filled('status')) {
                    $querySearch->where('is_active', $request->status);
                }
                if ($request->name) {
                    $querySearch->where('customer_name', 'like', '%' . $request->name . '%');
                }
                if ($request->email) {
                    $querySearch->where('email', 'like', '%' . $request->email . '%');
                }
                if ($request->address) {
                    $querySearch->where('address', 'like', '%' . $request->address . '%');
                }
                $results = $querySearch;
            }

            return Datatables::of($results)
                ->addIndexColumn()
                ->addColumn(
                    'action',
                    function ($results) {
                        $btn = '<button class="popupEditCustomer" data-toggle="modal" data-target=".popupCustomer" data-id=' . $results->customer_id . '  type="button" id="' . 'popupEditCustomer' . $results->customer_id . '"><i class="fa fa-pencil"></i></button>';
                        return $btn;
                    }
                )
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
