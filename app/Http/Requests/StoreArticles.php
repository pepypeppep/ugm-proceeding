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
            'abstract' => 'required|string',
            'authors' => 'required|array',
            'doi' => 'required|string',
            'end_page' => 'required|integer',
            'file_type' => 'required|string',
            'file_link' => 'string|required_if:file_type,scopus,doaj',
            'file_pdf' => 'mimes:pdf|required_if:file_type,pdf',
            'keywords' => 'required|string',
            'proceeding_id' => 'required|exists:proceedings,id',
            'title' => 'required|string',
            'authors.*.affiliation' => 'required|string',
            'authors.*.email' => 'required|email',
            'authors.*.name' => 'required|string',
        ];
    }
}
