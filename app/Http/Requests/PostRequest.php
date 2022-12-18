<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
         $rules =  [
            'title'=>'required|regex:/^[\pL\s\-]+$/u|unique:posts,title|max:255',
            'author'=>'required|max:255',
            'image'=>'required|mimes:jpeg,jpg,png|max:2048',
            'content'=>'required|min:20',
        ];

        // if update post
        if(in_array($this->method(),['PUT','PATCH'])){
            $posts_id = $this->route()->parameter('post');
            $rules['title'] = ['required','regex:/^[\pL\s\-]+$/u',Rule::unique('posts','title')->ignore($posts_id ,'id')];
            $rules['image'] = 'nullable|mimes:jpeg,jpg,png|max:2048';
        }

        return $rules;
    }
}
