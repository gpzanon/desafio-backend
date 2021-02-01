<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ChecaNomeCompleto implements Rule
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
        $qtd_palavaras = explode(" ", $value);

        return count($qtd_palavaras) > 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O nome precisa conter mais de 1 palavra.';
    }
}
