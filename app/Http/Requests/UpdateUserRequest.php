<?php
/**
 * Use for validator reuqest
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
class UpdateUserRequest extends FormRequest
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
        $id = $this->request->get('id') ? ',' . $this->request->get('id') : '';
        return [
            'name' => 'required|min:5',
            'email' => 'required|max:255|email:rfc,dns|unique:users,email' . $id,
            'password' => 'sometimes|required|min:5|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'password_confirmation' => 'sometimes|required|min:5|same:password',
            'group_role' => 'required',
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

            "name.required" => "Vui lòng nhập tên người sử dụng",
            "name.min" => "Tên phải lớn hơn 5 ký tự",

            "group_role.required" => "Vui lòng chọn nhóm",

            "email.required" => "Email không được để trống",
            "email.email" => "Email không đúng định dạng",
            "email.exists" => "Email không tồn tại",
            "email.unique" => "Email này đã được đăng ký",

            "email.max" => "Email quá dài",

            "password.required" => "Mật khẩu không được để trống",
            "password.min" => "Mật khẩu phải lớn hơn 5 ký tự",
            "password.regex" => "Mật khẩu không bảo mật",

            "password_confirmation.required" => "Xác nhận mật khẩu",
            "password_confirmation.min" => "Mật khẩu phải lớn hơn 5 ký tự",
            "password_confirmation.same" => "Mật khẩu và xác nhận mật khẩu không chính xác",

        ];
    }
    /**
     * Return validation error message
     *
     * @return array
     */
    protected function prepareForValidation()
    {
        if ($this->password == null) {
            $this->request->remove('password');
            $this->request->remove('password_confirmation');
        }
    }
}
