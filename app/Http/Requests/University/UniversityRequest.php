<?php

namespace App\Http\Requests\University;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Response;

class UniversityRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:university,name'],
            'code' => ['required', 'string', 'max:255', 'unique:university,code'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Kolom Nama harus di isi',
            'code.required' => 'Kolom Kode harus di isi',
            'email.required' => 'Kolom email harus di isi',
            'address.required' => 'Kolom Alamat harus di isi',
            'phone.required' => 'Kolom Nomor Telepon harus di isi',
            'email.email' => 'Kolom Email harus memiliki format email',
            'name.unique' => 'Nama Universitas sudah ada',
            'code.unique' => 'Kode Universitas sudah ada',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(
            Response::json([
                'status' => 'error',
                'data' => collect($errors)->flatten()->toArray(),
            ], 422)
        );
    }
}