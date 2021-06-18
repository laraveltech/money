<?php

namespace LaravelTech\Money;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Money\Currency;
use Money\Exception\UnknownCurrencyException;
use Money\Formatter\DecimalMoneyFormatter;

/**
 * Class MoneyCast
 * @package LaravelTech\Money
 */
class MoneyCast implements CastsAttributes
{
    /**
     * @var string
     */
    public ?string $currency;

    /**
     * MoneyCast constructor.
     * @param string|null $currency
     */
    public function __construct(string $currency = null)
    {
        $this->currency = $currency;
    }

    /**
     * @param Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return Money|null
     */
    public function get($model, string $key, $value, array $attributes): ?Money
    {
        if (is_null($value)) {
            return null;
        }

        return new Money($value, $this->getCurrency($attributes));
    }

    /**
     * @param Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return array
     */
    public function set($model, string $key, $value, array $attributes): array
    {
        if ($value instanceof Money) {
            $formatted = $value->getAmount();
        } else {
            $formatted = $value;
        }

        if (array_key_exists($this->currency, $attributes)) {
            return [$key => $formatted, $this->currency => $this->getCurrency($attributes)];
        }

        return [$key => $formatted];
    }

    /**
     * @param array $attributes
     * @return Currency
     */
    protected function getCurrency($attributes)
    {
        if (array_key_exists($this->currency, $attributes)) {
            $this->currency = $attributes[$this->currency];
        }

        if (is_null($this->currency)) {
            $this->currency = Money::getDefaultCurrency();
        }

        $currency = new Currency($this->currency);

        if (!Money::getCurrencies()->contains($currency)) {
            throw new UnknownCurrencyException(sprintf('Cannot find currency %s.', $currency->getCode()));
        }

        return $currency;
    }
}
