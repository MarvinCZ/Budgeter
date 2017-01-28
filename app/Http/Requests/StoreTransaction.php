<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransaction extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //TODO check if user can do this
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
            'value' => 'required|numeric',
            'description' => 'required|max:150',
            'member_ids' => 'required|valid_members:group'
        ];
    }

    /**
     * Add parameters to be validated
     * 
     * @return array
     */
    public function all()
    {
        return array_replace_recursive(
            parent::all(),
            $this->route()->parameters()
        );
    }
}
