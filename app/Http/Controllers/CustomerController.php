<?php
/**
 * Customer controller
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

use App\Exports\CustomersExport;
use App\Http\Requests\AddCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Imports\CustomersImport;
use App\Repositories\CustomerRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Handle CRUD Customer
 *
 * @category  Controllers
 * @package   App
 * @author    Phuc <phan.phuc.rcvn2012@gmail.com>
 * @copyright 2016 CriverCrane! Corporation. All Rights Reserved.
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      http://localhost/
 */
class CustomerController extends Controller
{
    /**
     * Inject customer Repository to construct
     */
    protected $customerRepository;
    /**
     * Create a new controller instance.
     *
     * @param $customerRepository use for query
     *
     * @return void
     */
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }
    /**
     * Show all customer .
     *
     * @param \Illuminate\Http\Request $request submitted by users
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                return $this->customerRepository->customerSearching($request);
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
    public function store(AddCustomerRequest $request)
    {
        try {
            $this->customerRepository->create($request->all());
            return $this->successResponce($message = 'New customer added');

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
    public function update(UpdateCustomerRequest $request, $id)
    {
        try {
            $this->customerRepository->update($id, $request->all());
            return $this->successResponce($message = 'Update customer successfully');
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
            $product = $this->customerRepository->getCustomerDetails($id);
            return $this->successResponce($product, $message = 'Get product details successfully'); //phpcs:ignore
        } catch (\Throwable $th) {
            return $this->errorsResponce($message = 'Somethings went wrong, try agian!'); //phpcs:ignore
        }

    }
    /**
     * Export customer resources
     *
     * @param \Illuminate\Http\Request $request submitted by users
     *
     * @return CSV file
     */
    public function export(Request $request)
    {
        return Excel::download(new CustomersExport($request), 'customers.xlsx');
    }
    /**
     * Export customer resources
     *
     * @return void
     */
    public function import()
    {
        Excel::import(new CustomersImport, request()->file('customersFile'));

        return $this->successResponce($message = 'Import customers successfully');
    }
}
