<?php

namespace App\Http\Requests;

use Request;
use Illuminate\Foundation\Http\FormRequest;

class OptionRequest extends FormRequest
{
     protected $redirect = 'admin/option';
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
            'contact_title'    => 'Required|Min:3|Max:100',
            'contact_description'    => 'Required|Min:3|Max:1000',
            'call_title'    => 'Required|Min:3|Max:100',
            'call_number'    => 'Required|Min:8|Max:15',
            'email_title'    => 'Required|Min:3|Max:100',
            'email_address'    => 'Required|email',
            
        ];
    }

    public function after($validator)
    {
        if ($validator->errors()->first() != "") {
            $validator->errors()->add('page', 'contact');
            $validator->errors()->add('contact', 'bloc_contact_left');
        }
    }

    protected function getValidatorInstance()
    {
        return parent::getValidatorInstance()->after(function ($validator) {
            $this->after($validator);
        });
    }
}
