<?php

namespace App\Http\Requests\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class OtherUser implements Rule
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

        //check user with email exist or not login user email
        if(User::where('email',$value)->count() > 0 && $value != auth()->user()->email){
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return "Email should exist in our system and not your ID";
        
    }
}
