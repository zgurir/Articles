<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;



class PostRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->slug ?? $this->title),
        ]);
    }

    public function rules(Request $request): array
    {
        return [
            'title' => ['required', 'string', 'between:3,255'],
            'slug' => ['required', 'string', 'between:3,255', Rule::unique('posts')->ignore($this->post)],
            'content' => ['required', 'string', 'min:10'],
            'thumbnail' => [Rule::requiredIf($request->isMethod('post')), 'image'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'tag_ids' => ['array', 'exists:tags,id'],
        ];
    }
}
