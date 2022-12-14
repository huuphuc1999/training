<?php
/**
 * Import customer
 *
 * PHP version 7
 *
 * @category  Import
 * @package   Maatwebsite
 * @author    Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
 * @copyright 2016 CriverCrane! Corporation. All Rights Reserved.
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      http://localhost/
 */
namespace App\Imports;

use App\Models\Customer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

/**
 * Handle request
 *
 * @category  Import
 * @package   Maatwebsite
 * @author    Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
 * @copyright 2016 CriverCrane! Corporation. All Rights Reserved.
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      http://localhost/
 */
class CustomersImport implements ToModel, WithValidation, WithStartRow, WithBatchInserts, WithChunkReading, ShouldQueue
{
    use Importable;
    /**
     * Import customers
     *
     * @param array $row for display
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Customer(
            [
                'customer_name' => $row[0],
                'email' => $row[1],
                'tel_num' => $row[2],
                'address' => $row[3],
            ]
        );
    }
    public function batchSize(): int
    {
        return 1000;
    }
    public function chunkSize(): int
    {
        return 1000;
    }
    /**
     * Ignore heading row
     *
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
    /**
     * Validate row input
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            '0' => 'required|min:5',
            '1' => 'required|max:255|email:rfc,dns|unique:customers,email',
            '2' => 'required|regex:/^([0-9]*)$/|min:7|max:13',
            '3' => 'required|max:255',
        ];
    }
    /**
     * @return array
     */
    public function customValidationAttributes()
    {
        return ['0' => 'customer_name'];
        return ['1' => 'email'];
        return ['2' => 'tel_num'];
        return ['3' => 'address'];
    }
    /**
     * Custom message
     *
     * @return array
     */
    public function customValidationMessages()
    {
        return [
            "0.required" => "Vui l??ng nh???p t??n kh??ch h??ng",
            "0.min" => "T??n ph???i l???n h??n 5 k?? t???",

            "1.required" => "Email kh??ng ???????c ????? tr???ng",
            "1.email" => "Email kh??ng ????ng ?????nh d???ng",
            "1.exists" => "Email kh??ng t???n t???i",
            "1.unique" => "Email ???? ???????c ????ng k??",
            "1.max" => "Email qu?? d??i",

            "2.required" => "??i???n tho???i kh??ng ???????c ????? tr???ng",
            "2.regex" => "??i???n tho???i kh??ng ????ng ?????nh d???ng",
            "2.min" => "??i???n tho???i kh??ng ????ng ?????nh d???ng",
            "2.max" => "??i???n tho???i kh??ng ????ng ?????nh d???ng",

            "3.required" => "?????a ch??? kh??ng ???????c ????? tr???ng",
            "3.max" => "?????a ch??? qu?? d??i",
        ];
    }
}
