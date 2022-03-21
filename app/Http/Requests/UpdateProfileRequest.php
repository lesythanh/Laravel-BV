<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name' => 'required|max:50',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Không được để trống tên',
            'email.required' => 'Không được để trống Email',
            'address.required' => 'Không được để trống địa chỉ',
            'phone.required' => 'Không được để trống số điện thoại',
            'avatar.image' => 'File không đúng định dạng',
            'avatar.max' => 'File ảnh vượt quá mức dung lượng cho phép'
        ];
    }
}
