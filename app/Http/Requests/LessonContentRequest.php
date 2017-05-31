<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonContentRequest extends FormRequest
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
        $rules = [];

        // For 1 pair of input, count=1, but should start from 0
        $count = count($this->input('document_title'))-1;
        foreach(range(0, $count) as $index) {
            $rules['document_title.'.$index] = 'required|max:255';
            $rules['document_file.'.$index] = 'required|max:5120'; // 5 MB
        }

        return $rules;
    }
}
