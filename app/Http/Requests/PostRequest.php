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
        $rules =  [
            'title'         => 'required',
            'slug'          => 'required|unique:posts',
            'excerpt'       => 'required',
            'body'          => 'required',
            'category_id'   => 'required',
            'published_at'  => 'nullable|date_format:Y-m-d H:i:s',
            'image' => 'mimes:jpg,jpeg,png'
        ];
        switch ($this->method()) {
            case 'PUT':
            case 'PATCH':
                $rules['slug'] = 'required|unique:posts,slug,'.$this->route('blog');
                break;
        }
        return $rules;
    }
}
