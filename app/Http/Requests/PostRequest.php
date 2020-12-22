<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
          'title' => 'required|max:50',
          'body' => 'required|max:2000',
          'user_id' => 'required|numeric',
          'category_id' => 'required|numeric',
          'image' => 'file|image|mimes:png,jpeg'
        ];
    }

    public function messages()
   {
      return [
        'title.required' => 'タイトルを入力してください',
        'title.max' => '50文字以内で入力してください',
        'body.required' => '内容を入力してください',
        'body.max' => '2000文字以内で入力してください',
        'category_id.required' => 'カテゴリーを選択してください',
        'category_id.numeric' => 'カテゴリーを選択してください',
        'image.file' => 'ファイルを用意してください',
        'image.image' => '画像に限ります',
        'image.mimes' => '画像ファイル形式は、png,jpegに限ります',
      ];
   }
}
