<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ChecaMascaraCpf implements Rule
{
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
        $regex = '#^[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}$#';

        if (preg_match($regex, $value)) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O CPF precisa estar no formato 999.999.999-99';
    }
}
