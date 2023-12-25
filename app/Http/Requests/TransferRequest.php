<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Rules\UserAmount;
use App\Http\Requests\Rules\OtherUser;

class TransferRequest extends FormRequest
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
            'email' => ['required','email','max:250',new OtherUser()],           
            'amount' => ["required","regex:/^(\d+(\.\d*)?)|(\.\d+)$/" ,new UserAmount()]
        ];
    }
}
