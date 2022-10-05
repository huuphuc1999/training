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
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
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
class CustomersImport implements ToModel, WithValidation, WithHeadingRow
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
    /**
     * Ignore heading row
     *
     * @return void
     */
    public function headingRow(): int
    {
        return 1;
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
            '1' => 'required|max:255|email:rfc,dns|unique:customers',
            '2' => 'required|regex:/^([0-9]*)$/|min:7|max:13',
            '3' => 'required|max:255',
        ];
    }
    /**
     * Custom message
     *
     * @return array
     */
    public function customValidationMessages()
    {
        return [
            "0.required" => "Vui lòng nhập tên khách hàng",
            "0.min" => "Tên phải lớn hơn 5 ký tự",

            "1.required" => "Email không được để trống",
            "1.email" => "Email không đúng định dạng",
            "1.exists" => "Email không tồn tại",
            "1.unique" => "Email đã được đăng ký",
            "1.max" => "Email quá dài",

            "2.required" => "Điện thoại không được để trống",
            "2.regex" => "Điện thoại không đúng định dạng",
            "2.min" => "Điện thoại không đúng định dạng",
            "2.max" => "Điện thoại không đúng định dạng",

            "3.required" => "Địa chỉ không được để trống",
            "3.max" => "Địa chỉ quá dài",
        ];
    }
}
