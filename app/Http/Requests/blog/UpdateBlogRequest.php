<?php

namespace App\Http\Requests\blog;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
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
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Không được để trống tiêu đề',
            'image.required' => 'Bạn chưa thêm hình ảnh',
            'image.image' => 'File không đúng định dạng',
            'description.required' => 'Mô tả Không được để trống',
            'content.required' => 'Không được để trống nội dung',
        ];
    }
}
