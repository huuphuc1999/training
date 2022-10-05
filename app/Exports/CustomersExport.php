<?php
/**
 * Export customer
 *
 * PHP version 7
 *
 * @category  Export
 * @package   Maatwebsite
 * @author    Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
 * @copyright 2016 CriverCrane! Corporation. All Rights Reserved.
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      http://localhost/
 */
namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

/**
 * Handle request
 *
 * @category  Export
 * @package   Maatwebsite
 * @author    Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
 * @copyright 2016 CriverCrane! Corporation. All Rights Reserved.
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      http://localhost/
 */
class CustomersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * Inject request to construct
     *
     * @param \Illuminate\Http\Request $request submitted by users
     */
    public function __construct($request)
    {
        $this->request = $request;
    }
    /**
     * Query customer before exproting
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $querySearch = \App\Models\Customer::query();
        if ($this->request->load == 'index') {
            $results = $querySearch
                ->orderBy('customer_id', 'DESC')
                ->limit(20)
                ->get();
        }
        if ($this->request->load == 'search') {
            if ($this->request->filled('status')) {
                $querySearch
                    ->where('is_active', $this->request->status);
            }
            if ($this->request->name) {
                $querySearch
                    ->where('customer_name', 'like', '%' . $this->request->name . '%');
            }
            if ($this->request->email) {
                $querySearch
                    ->where('email', 'like', '%' . $this->request->email . '%');
            }
            if ($this->request->address) {
                $querySearch
                    ->where('address', 'like', '%' . $this->request->address . '%');
            }
            $results = $querySearch->get();
        }
        return $results;
    }
    /**
     * Returns headers for report
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Tên khách hàng',
            'Email',
            'TelNum',
            "Địa chỉ",
        ];
    }
    /**
     * Mapping data with headers
     *
     * @param $customer used for mapping
     *
     * @return array
     */
    public function map($customer): array
    {
        return [
            $customer->customer_name,
            $customer->email,
            $customer->tel_num,
            $customer->address,
        ];
    }
}
