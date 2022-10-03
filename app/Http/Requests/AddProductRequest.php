<?php
/**
 * Use for validator request
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
class AddProductRequest extends FormRequest
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
        return [
            'productName' => 'required|min:5',
            'productPrice' => 'required|min:0|numeric',
            'productStatus' => 'in:0,1',
            'productImage' => 'mimes:jpeg,jpg,png|max:2048|dimensions:max_width=1024,max_height=1024',
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

            "productName.required" => "Vui lòng nhập tên sản phẩm",
            "productName.min" => "Sản phẩm phải lớn hơn 5 ký tự",

            "productPrice.required" => "Giá bán không được để trống",
            "productPrice.numeric" => "Giá bán chỉ được nhập số",
            "productPrice.min" => "Giá bán không được nhỏ hơn 0",

            "productImage.mimes" => "Chỉ chấp nhận file png, jpg, jpeg",
            "productImage.max" => "Dung lượng ảnh không được vượt quá 2Mb",
            "productImage.dimensions" => "Ảnh quá lớn",

        ];
    }
    /**
     * Return validation error message
     *
     * @return array
     */
    // protected function prepareForValidation()
    // {
    //     if ($this->productImage == null) {
    //         $this->request->remove('productImage');
    //     }
    // }
}
