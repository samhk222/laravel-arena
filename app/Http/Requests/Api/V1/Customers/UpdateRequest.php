<?php

namespace App\Http\Requests\Api\V1\Customers;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name'      => 'required',
            'document'  => 'required|min:6|max:12',
            'user_id'   => 'exists:users,id',
            'status_id' => 'exists:statuses,id'
        ];
    }


    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    public function validationData()
    {
        return $this->merge(['user_id' => \auth()->id()])->toArray();
    }
}
