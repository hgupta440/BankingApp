<?php

namespace App\Http\Requests\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class UserAmount implements Rule
{
    /**
     * Value assign
     *
     * @var string
     */
    protected $value;


    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
   
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {        
        return ($value <= auth()->user()->amount);
    }

    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return "Amount should less than or equal to  available in account";
        
    }
}
