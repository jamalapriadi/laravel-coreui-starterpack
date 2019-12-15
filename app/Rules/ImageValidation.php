<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ImageValidation implements Rule
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
        $base64String = $value;

        $pos  = strpos($base64String, ';');
        $type = explode(':', substr($base64String, 0, $pos))[1];

        $stringLength = strlen($base64String) - strlen('data:'.$type.';base64,');

        $sizeInBytes = 4 * ceil(($stringLength / 3))*0.5624896334383812;
        $sizeInKb=$sizeInBytes/1000;

        return $sizeInKb < 1000;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Ukuran file image tidak boleh lebih dari 1 MB';
    }
}
