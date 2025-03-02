<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['required', 'string', 'min:10'],
            'category_id' => ['exists:categories,id'],
            // 'status' => ['required', 'in:0,1'],
            'comment_able' => ['required', 'in:on,off'],
            'images' => ['required'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ];
    }
    // public function messages(): array
    // {
    //     return [
    //         'title.required' => 'Please Enter Title',
    //         'description.required' => 'Nội dung bài viết không được để trống',
    //         'category_id.required' => 'Chủ đề bài viết không được để trống',
    //         'status.required' => 'Trạng thái bài viết không được để trống',
    //         'comment_able.required' => 'Bình luận bài viết không được để trống',
    //         'image.required' => 'Hình ảnh bài viết không được để trống',
    //     ];
    // }
    // public function attributes(): array
    // {
    //     return [
    //         'title' => 'titles',
    //         'description' => 'Nội dung bài viết',
    //         'category_id' => 'Chủ đề bài viết',
    //         'status' => 'Trạng thái bài viết',
    //         'comment_able' => 'Bình luận bài viết',
    //         'image' => 'Hình ảnh bài viết',
    //     ];
    // }
}
