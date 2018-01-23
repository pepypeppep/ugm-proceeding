<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticles extends FormRequest
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
            'abstract' => 'required|array|size:'.count(request('title')),
            'author_name' => 'required|array|size:'.count(request('title')),
            'author_email' => 'required|array|size:'.count(request('title')),
            'author_affiliation' => 'required|array|size:'.count(request('title')),
            'doi' => 'required|array|size:'.count(request('title')),
            'end_page' => 'required|array|size:'.count(request('title')),
            'keywords' => 'required|array|size:'.count(request('title')),
            'title' => 'required|array',
            'start_page' => 'required|array|size:'.count(request('title')),
            'abstract.*' => 'required|string',
            'author_name.*.*' => 'required|string',
            'author_affiliation.*.*' => 'required|string',
            'author_email.*.*' => 'required|email',
            'doi.*' => 'required|string',
            'end_page.*' => 'required|integer',
            'keywords.*' => 'required|string',
            'file_type.*' => 'required|string',
            'file_pdf.*' => 'mimes:pdf',
            'file_link.*' => 'string',
            'proceeding_id' => 'required|exists:proceedings,id',
            'start_page.*' => 'required|integer',
            'title.*' => 'required|string',
        ];
    }
}
