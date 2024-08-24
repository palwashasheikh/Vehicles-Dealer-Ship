<?php

if (!function_exists('present')) {
    /**
     * Check if a variable is present (not null, not an empty string and not an empty array).
     *
     * @param  mixed  $value
     * @return bool
     */
    function present($variable)
    {
        if (!isset($variable))
            return null;

        if (is_array($variable))
            return count($variable) > 0;

        return $variable !== '';
    }
}

if (!function_exists('presence')) {
    /**
     * Check if a variable is present (not null, not an empty string and not an empty array).
     *
     * @param  mixed  $value
     * @return mixed
     */
    function presence($variable, $default = null)
    {
        return present($variable) ? $variable : $default;
    }
}

if (!function_exists('koshish')) {
    /**
     * Try to run a method on a variable, or access a key in an array. otherwise return fallback value or function
     * @param $target
     * @param $var
     * @param $fallback
     * @return mixed|null
     */
    function koshish($target, $var, $fallback = null)
    {
        if (!present($target))
            return is_callable($fallback) ? $fallback() : $fallback;

        try {
            if (is_array($target))
                return $target[$var];
            else
                return is_callable($var) ? $target->{$var}() : $target->{$var};
        } catch (Throwable $e) {
            return is_callable($fallback) ? $fallback() : $fallback;
        }
    }
}


if (!function_exists('currentyFormat')) {
    /**
     * Check if a variable is present (not null, not an empty string and not an empty array).
     *
     * @param  int|null  $amountInCents
     * @return string
     */
    function currentyFormat(int|null $amountInCents): string
    {
        return present($amountInCents) ? \Illuminate\Support\Number::currency(amountInDollars($amountInCents)) : '';
    }
}


if (!function_exists('amountInDollars')) {
    /**
     * Check if a variable is present (not null, not an empty string and not an empty array).
     *
     * @param  int|null  $amountInCents
     * @return string
     */
    function amountInDollars(int|null $amountInCents): float
    {
        return $amountInCents / 100;
    }
}

if (!function_exists('percentage')) {
    /**
     * @param $percentage
     * @return float
     */
    function percentage($percentage): float
    {
        return $percentage / 100;
    }
}

if (!function_exists('formatPhoneNumberUS')) {
    /**
     * Format phone number to US format '+1 123-456-7890'
     * @param $phoneNumber
     * @return string
     */
    function formatPhoneNumberUS($phoneNumber): string
    {
        $phoneNumber = preg_replace('/[^\d]/', '', $phoneNumber);

        if (preg_match('/^1\d{10}$/', $phoneNumber)) {
            return '+' . substr($phoneNumber, 0, 1)
                . ' ' . substr($phoneNumber, 1, 3)
                . '-' . substr($phoneNumber, 4, 3)
                . '-' . substr($phoneNumber, 7, 4);
        } else {
            return '+1 ' . substr($phoneNumber, 1, 3)
                . '-' . substr($phoneNumber, 4, 3)
                . '-' . substr($phoneNumber, 7, 4);
        }
    }
}

if (!function_exists('deformatPhoneNumber')) {
    /**
     * Remove all formatting from phone number and return as plain number
     * @param $phoneNumber
     * @return string
     */
    function deformatPhoneNumber($phoneNumber): string
    {
        return preg_replace('/[^\d]/', '', $phoneNumber);
    }
}
