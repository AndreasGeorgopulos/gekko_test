<?php

namespace App\Rules;

use App\Models\Secret;
use Illuminate\Contracts\Validation\Rule;

class HashRule implements Rule
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
        return !(bool) Secret::where('hash', sha1($value))->count();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This :attribute is exists.';
    }
}
