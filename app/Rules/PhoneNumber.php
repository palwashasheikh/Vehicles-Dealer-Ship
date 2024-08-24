<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PhoneNumber implements ValidationRule
{
    public function __construct(protected string $countryCode)
    {
    }

    /**
     * Validate the phone number format.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        switch (strtolower($this->countryCode)) {
            case 'us':
                if (!preg_match('/^(\+?1)?\d{10}$/', $value))
                    $fail('The :attribute must be a valid US phone number.');

                break;
        }
    }
}
