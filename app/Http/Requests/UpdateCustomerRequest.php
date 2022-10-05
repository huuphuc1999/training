<?php
/**
 * Customer for validator request
 *
 * PHP version 7
 *
 * @category  Request
 * @package   App
 * @author    Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
 * @copyright 2016 CriverCrane! Corporation. All Rights Reserved.
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      http://localhost/
 */
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Handle request
 *
 * @category  Request
 * @package   App
 * @author    Phan.Phuc <phan.phuc.rcvn2012@gmail.com>
 * @copyright 2016 CriverCrane! Corporation. All Rights Reserved.
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      http://localhost/
 */
class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->request->get('customer_id') ? ',' . $this->request->get('customer_id') : '';
        return [
            'customer_name' => 'required|min:5',
            'email' => 'required|max:255|email:rfc,dns|unique:customers,email' . $id . ',customer_id',
            'tel_num' => 'required|regex:/^([0-9]*)$/|min:7|max:13',
            'address' => 'required|max:255',
        ];
    }
    /**
     * Return validation error message
     *
     * @return array
     */
    public function messages()
    {
        return [

            "customer_name.required" => "Vui lòng nhập tên khách hàng",
            "customer_name.min" => "Tên phải lớn hơn 5 ký tự",

            "email.required" => "Email không được để trống",
            "email.email" => "Email không đúng định dạng",
            "email.exists" => "Email không tồn tại",
            "email.unique" => "Email đã được đăng ký",
            "email.max" => "Email quá dài",

            "tel_num.required" => "Điện thoại không được để trống",
            "tel_num.regex" => "Điện thoại không đúng định dạng",
            "tel_num.min" => "Điện thoại không đúng định dạng",
            "tel_num.max" => "Điện thoại không đúng định dạng",

            "address.required" => "Địa chỉ không được để trống",
            "address.max" => "Địa chỉ quá dài",

        ];
    }
}
