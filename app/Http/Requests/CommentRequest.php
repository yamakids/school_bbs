<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
          'post_id' => 'required|exists:posts,id',
          'user_id' => 'required|numeric',
          'body' => 'required|max:2000',
          'image' => 'file|image|mimes:png,jpeg'
        ];
    }

    public function messages()
   {
      return [
        'body.required' => '内容を入力してください',
        'body.max' => '2000文字以内で入力してください',
        'image.file' => 'ファイルを用意してください',
        'image.image' => '画像に限ります',
        'image.mimes' => '画像ファイル形式は、png,jpegに限ります',
      ];
   }
}
