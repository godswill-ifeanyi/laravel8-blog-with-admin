<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PostFormRequest extends FormRequest
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
        $rules = [
            'category_id' => ['required','integer'],
            'name' => ['required','string','max:200'],
            'slug' => ['nullable','string','max:200'],
            'description' => ['required'],
            'image_path' => ['nullable','mimes:jpg,png,jpeg'],
            'yt_iframe' => ['nullable','string','max:200'],
            'meta_title' => ['required','string','max:200'],
            'meta_description' => ['nullable'],
            'meta_keyword' => ['nullable'],
            'status' => ['nullable'],
        ];
        return $rules;
    }
}
