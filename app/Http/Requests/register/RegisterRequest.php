<?php

namespace App\Http\Requests\register;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:9|max:12',
            'phone' => 'required',
            'address' => 'required',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Không được để trống tên',
            'email.required' => 'Không được để trống email',
            'password.required' => 'Không được để trống password',
            'phone.required' => 'Không được để trống số điện thoại',
            'address.required' => 'Không được để trống địa chỉ',
            'avatar.required' => 'Bạn chưa thêm hình ảnh',
            'avatar.image' => 'File không đúng định dạng',
        ];
    }
}
