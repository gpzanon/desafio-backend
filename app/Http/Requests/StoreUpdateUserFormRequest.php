<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidCpf;
use App\Rules\ValidName;

class StoreUpdateUserFormRequest extends FormRequest
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
        // Get the user id of the 3rd route parameter
        $id = $this->segment(3);

        return [
            'email'     => "required|string|email|unique:users,email,{$id},id",
            'password'  => 'confirmed',
            'name'      => [
                'required',
                'string',
                'min:3',
                'max:255',
                new ValidName,
            ],
            'cpf'       => [
                'required',
                'string',
                'min:14',
                'max:14',
                new ValidCpf,
            ],
            'image'     => 'image'

        ];
    }
}
