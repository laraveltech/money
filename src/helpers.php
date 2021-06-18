<?php

use LaravelTech\Money\Money;
use Money\Currency;

if (!function_exists('money')) {
    /**
     * @param Money|\Money\Money|int|float|string $amount
     * @param Currency|string|null $currency
     * @return Money
     */
    function money($amount, $currency = null)
    {
        return new Money(
            $amount,
            new Currency($currency ?: config('money.defaultCurrency'))
        );
    }
}
