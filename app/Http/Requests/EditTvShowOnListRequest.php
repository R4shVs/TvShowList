<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class EditTvShowOnListRequest extends FormRequest
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
        return [
            'priority' => ['required', 'integer'],
        ];;
    }
    public function messages()
    {
        return [
            'required' => ':attribute must be provided',
        ];
    }

    /**
     * Return validation errors as json response
     *
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = collect($validator->errors());
         
        
        $response = [
            'errors' => $errors->flatten()->all()
        ];

        throw new HttpResponseException(response()->json($response, 422));
    }
}
