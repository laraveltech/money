<?php

namespace LaravelTech\Money;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Renderable;
use JsonSerializable;
use Money\Currencies\AggregateCurrencies;
use Money\Currencies\BitcoinCurrencies;
use Money\Currencies\CurrencyList;
use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Exception\UnknownCurrencyException;
use Money\Formatter\DecimalMoneyFormatter;
use Money\Formatter\IntlMoneyFormatter;
use Money\Parser\DecimalMoneyParser;

/**
 * Class Money
 * @package LaravelTech\Money
 *
 * @method bool isSameCurrency(Money $other)
 * @method bool equals(Money $other)
 * @method int compare(Money $other)
 * @method bool greaterThan(Money $other)
 * @method bool greaterThanOrEqual(Money $other)
 * @method bool lessThan(Money $other)
 * @method bool lessThanOrEqual(Money $other)
 * @method Money add(Money ...$addends)
 * @method Money subtract(Money ...$subtrahends)
 * @method Money multiply($multiplier, $roundingMode = \Money\Money::ROUND_HALF_UP)
 * @method Money divide($divisor, $roundingMode = \Money\Money::ROUND_HALF_UP)
 * @method Money mod(Money $divisor)
 * @method Money[] allocate(array $ratios)
 * @method Money[] allocateTo($n)
 * @method string ratioOf(Money $money)
 * @method Money absolute()
 * @method Money negative()
 * @method bool isZero()
 * @method bool isPositive()
 * @method bool isNegative()
 * @method static Money min(Money $first, Money ...$collection)
 * @method static Money max(Money $first, Money ...$collection)
 * @method static Money sum(Money $first, Money ...$collection)
 * @method static Money avg(Money $first, Money ...$collection)
 * @method static Money AED(string|float|int $amount)
 * @method static Money ALL(string|float|int $amount)
 * @method static Money AMD(string|float|int $amount)
 * @method static Money ANG(string|float|int $amount)
 * @method static Money AOA(string|float|int $amount)
 * @method static Money ARS(string|float|int $amount)
 * @method static Money AUD(string|float|int $amount)
 * @method static Money AWG(string|float|int $amount)
 * @method static Money AZN(string|float|int $amount)
 * @method static Money BAM(string|float|int $amount)
 * @method static Money BBD(string|float|int $amount)
 * @method static Money BDT(string|float|int $amount)
 * @method static Money BGN(string|float|int $amount)
 * @method static Money BHD(string|float|int $amount)
 * @method static Money BIF(string|float|int $amount)
 * @method static Money BMD(string|float|int $amount)
 * @method static Money BND(string|float|int $amount)
 * @method static Money BOB(string|float|int $amount)
 * @method static Money BOV(string|float|int $amount)
 * @method static Money BRL(string|float|int $amount)
 * @method static Money BSD(string|float|int $amount)
 * @method static Money BTN(string|float|int $amount)
 * @method static Money BWP(string|float|int $amount)
 * @method static Money BYN(string|float|int $amount)
 * @method static Money BZD(string|float|int $amount)
 * @method static Money CAD(string|float|int $amount)
 * @method static Money CDF(string|float|int $amount)
 * @method static Money CHE(string|float|int $amount)
 * @method static Money CHF(string|float|int $amount)
 * @method static Money CHW(string|float|int $amount)
 * @method static Money CLF(string|float|int $amount)
 * @method static Money CLP(string|float|int $amount)
 * @method static Money CNY(string|float|int $amount)
 * @method static Money COP(string|float|int $amount)
 * @method static Money COU(string|float|int $amount)
 * @method static Money CRC(string|float|int $amount)
 * @method static Money CUC(string|float|int $amount)
 * @method static Money CUP(string|float|int $amount)
 * @method static Money CVE(string|float|int $amount)
 * @method static Money CZK(string|float|int $amount)
 * @method static Money DJF(string|float|int $amount)
 * @method static Money DKK(string|float|int $amount)
 * @method static Money DOP(string|float|int $amount)
 * @method static Money DZD(string|float|int $amount)
 * @method static Money EGP(string|float|int $amount)
 * @method static Money ERN(string|float|int $amount)
 * @method static Money ETB(string|float|int $amount)
 * @method static Money EUR(string|float|int $amount)
 * @method static Money FJD(string|float|int $amount)
 * @method static Money FKP(string|float|int $amount)
 * @method static Money GBP(string|float|int $amount)
 * @method static Money GEL(string|float|int $amount)
 * @method static Money GHS(string|float|int $amount)
 * @method static Money GIP(string|float|int $amount)
 * @method static Money GMD(string|float|int $amount)
 * @method static Money GNF(string|float|int $amount)
 * @method static Money GTQ(string|float|int $amount)
 * @method static Money GYD(string|float|int $amount)
 * @method static Money HKD(string|float|int $amount)
 * @method static Money HNL(string|float|int $amount)
 * @method static Money HRK(string|float|int $amount)
 * @method static Money HTG(string|float|int $amount)
 * @method static Money HUF(string|float|int $amount)
 * @method static Money IDR(string|float|int $amount)
 * @method static Money ILS(string|float|int $amount)
 * @method static Money INR(string|float|int $amount)
 * @method static Money IQD(string|float|int $amount)
 * @method static Money IRR(string|float|int $amount)
 * @method static Money ISK(string|float|int $amount)
 * @method static Money JMD(string|float|int $amount)
 * @method static Money JOD(string|float|int $amount)
 * @method static Money JPY(string|float|int $amount)
 * @method static Money KES(string|float|int $amount)
 * @method static Money KGS(string|float|int $amount)
 * @method static Money KHR(string|float|int $amount)
 * @method static Money KMF(string|float|int $amount)
 * @method static Money KPW(string|float|int $amount)
 * @method static Money KRW(string|float|int $amount)
 * @method static Money KWD(string|float|int $amount)
 * @method static Money KYD(string|float|int $amount)
 * @method static Money KZT(string|float|int $amount)
 * @method static Money LAK(string|float|int $amount)
 * @method static Money LBP(string|float|int $amount)
 * @method static Money LKR(string|float|int $amount)
 * @method static Money LRD(string|float|int $amount)
 * @method static Money LSL(string|float|int $amount)
 * @method static Money LYD(string|float|int $amount)
 * @method static Money MAD(string|float|int $amount)
 * @method static Money MDL(string|float|int $amount)
 * @method static Money MGA(string|float|int $amount)
 * @method static Money MKD(string|float|int $amount)
 * @method static Money MMK(string|float|int $amount)
 * @method static Money MNT(string|float|int $amount)
 * @method static Money MOP(string|float|int $amount)
 * @method static Money MRU(string|float|int $amount)
 * @method static Money MUR(string|float|int $amount)
 * @method static Money MVR(string|float|int $amount)
 * @method static Money MWK(string|float|int $amount)
 * @method static Money MXN(string|float|int $amount)
 * @method static Money MXV(string|float|int $amount)
 * @method static Money MYR(string|float|int $amount)
 * @method static Money MZN(string|float|int $amount)
 * @method static Money NAD(string|float|int $amount)
 * @method static Money NGN(string|float|int $amount)
 * @method static Money NIO(string|float|int $amount)
 * @method static Money NOK(string|float|int $amount)
 * @method static Money NPR(string|float|int $amount)
 * @method static Money NZD(string|float|int $amount)
 * @method static Money OMR(string|float|int $amount)
 * @method static Money PAB(string|float|int $amount)
 * @method static Money PEN(string|float|int $amount)
 * @method static Money PGK(string|float|int $amount)
 * @method static Money PHP(string|float|int $amount)
 * @method static Money PKR(string|float|int $amount)
 * @method static Money PLN(string|float|int $amount)
 * @method static Money PYG(string|float|int $amount)
 * @method static Money QAR(string|float|int $amount)
 * @method static Money RON(string|float|int $amount)
 * @method static Money RSD(string|float|int $amount)
 * @method static Money RUB(string|float|int $amount)
 * @method static Money RWF(string|float|int $amount)
 * @method static Money SAR(string|float|int $amount)
 * @method static Money SBD(string|float|int $amount)
 * @method static Money SCR(string|float|int $amount)
 * @method static Money SDG(string|float|int $amount)
 * @method static Money SEK(string|float|int $amount)
 * @method static Money SGD(string|float|int $amount)
 * @method static Money SHP(string|float|int $amount)
 * @method static Money SLL(string|float|int $amount)
 * @method static Money SOS(string|float|int $amount)
 * @method static Money SRD(string|float|int $amount)
 * @method static Money SSP(string|float|int $amount)
 * @method static Money STN(string|float|int $amount)
 * @method static Money SVC(string|float|int $amount)
 * @method static Money SYP(string|float|int $amount)
 * @method static Money SZL(string|float|int $amount)
 * @method static Money THB(string|float|int $amount)
 * @method static Money TJS(string|float|int $amount)
 * @method static Money TMT(string|float|int $amount)
 * @method static Money TND(string|float|int $amount)
 * @method static Money TOP(string|float|int $amount)
 * @method static Money TRY(string|float|int $amount)
 * @method static Money TTD(string|float|int $amount)
 * @method static Money TWD(string|float|int $amount)
 * @method static Money TZS(string|float|int $amount)
 * @method static Money UAH(string|float|int $amount)
 * @method static Money UGX(string|float|int $amount)
 * @method static Money USD(string|float|int $amount)
 * @method static Money USN(string|float|int $amount)
 * @method static Money UYI(string|float|int $amount)
 * @method static Money UYU(string|float|int $amount)
 * @method static Money UYW(string|float|int $amount)
 * @method static Money UZS(string|float|int $amount)
 * @method static Money VES(string|float|int $amount)
 * @method static Money VND(string|float|int $amount)
 * @method static Money VUV(string|float|int $amount)
 * @method static Money WST(string|float|int $amount)
 * @method static Money XAF(string|float|int $amount)
 * @method static Money XAG(string|float|int $amount)
 * @method static Money XAU(string|float|int $amount)
 * @method static Money XBA(string|float|int $amount)
 * @method static Money XBB(string|float|int $amount)
 * @method static Money XBC(string|float|int $amount)
 * @method static Money XBD(string|float|int $amount)
 * @method static Money XBT(string|float|int $amount)
 * @method static Money XCD(string|float|int $amount)
 * @method static Money XDR(string|float|int $amount)
 * @method static Money XOF(string|float|int $amount)
 * @method static Money XPD(string|float|int $amount)
 * @method static Money XPF(string|float|int $amount)
 * @method static Money XPT(string|float|int $amount)
 * @method static Money XSU(string|float|int $amount)
 * @method static Money XTS(string|float|int $amount)
 * @method static Money XUA(string|float|int $amount)
 * @method static Money XXX(string|float|int $amount)
 * @method static Money YER(string|float|int $amount)
 * @method static Money ZAR(string|float|int $amount)
 * @method static Money ZMW(string|float|int $amount)
 * @method static Money ZWL(string|float|int $amount)
 */
class Money implements Arrayable, Jsonable, JsonSerializable, Renderable
{
    /**
     * @var string|null
     */
    private static ?string $currency = null;

    /**
     * @var AggregateCurrencies|null
     */
    private static ?AggregateCurrencies $currencies = null;

    /**
     * @var \Money\Money
     */
    protected \Money\Money $money;

    /**
     * Money constructor.
     * @param Money|\Money\Money|int|float|string $amount
     * @param Currency|string|null $currency
     */
    public function __construct($amount, $currency = null)
    {
        if ($amount instanceof Money) {
            $money = $amount->getMoney();
        } elseif ($amount instanceof \Money\Money) {
            $money = $amount;
        } else {
            if (is_string($currency)) {
                $currency = new Currency($currency);
            }
            $parser = new DecimalMoneyParser(static::getCurrencies());
            $money = $parser->parse((string) $amount, $currency);
        }

        $this->money = $money;
    }

    /**
     * @param string $method
     * @param array $arguments
     * @return Money
     */
    public static function __callStatic(string $method, array $arguments): Money
    {
        if (method_exists(\Money\Money::class, $method)) {
            $result = call_user_func_array([\Money\Money::class, $method], static::getArguments($arguments));

            return static::newInstance($result);
        }

        return new Money($arguments[0], $method);
    }

    /**
     * @param $method
     * @param array $arguments
     * @return mixed
     */
    public function __call($method, array $arguments)
    {
        $result = call_user_func_array([$this->money, $method], static::getArguments($arguments));

        if ($result instanceof \Money\Money) {
            return static::newInstance($result);
        }

        if (is_array($result)) {
            $results = [];

            foreach ($result as $item) {
                $results[] = static::newInstance($item);
            }

            return $results;
        }

        return $result;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->format();
    }

    /**
     * @param Money|\Money\Money $money
     * @return Money
     */
    private static function newInstance($money): Money
    {
        if ($money instanceof \Money\Money) {
            $money = new Money($money);
        }

        return $money;
    }

    /**
     * @param array $arguments
     * @return array
     */
    private static function getArguments(array $arguments): array
    {
        $args = [];

        foreach ($arguments as $argument) {
            $args[] = $argument instanceof Money ? $argument->getMoney() : $argument;
        }

        return $args;
    }

    /**
     * @return string
     */
    public function format(): string
    {
        if (!$this->money) {
            return '';
        }

        if (array_key_exists($this->getCurrencyCode(), static::getCustomCurrencies())) {
            $formatter = new DecimalMoneyFormatter(static::getCurrencies());

            return $formatter->format($this->money) . ' ' . $this->getCurrencyCode();
        }

        $formatter = new IntlMoneyFormatter(new \NumberFormatter(app()->getLocale(), \NumberFormatter::CURRENCY), static::getCurrencies());

        return $formatter->format($this->money);
    }

    /**
     * @return string|null
     */
    public static function getDefaultCurrency(): ?string
    {
        if (!isset($currency)) {
            static::$currency = config('money.currency', 'USD');
        }

        return static::$currency;
    }

    /**
     * @param $currency
     * @return bool
     */
    private static function contains($currency): bool
    {
        return isset(static::getCurrencies()[$currency->getCode()]);
    }

    /**
     * @param Currency $currency
     * @return int
     */
    public static function subunitFor(Currency $currency): int
    {
        if (!static::contains($currency)) {
            throw new UnknownCurrencyException(sprintf('Cannot find currency %s.', $currency->getCode()));
        }

        return static::getCurrencies()[$currency->getCode()]['minorUnit'];
    }

    /**
     * @return AggregateCurrencies
     */
    public static function getCurrencies(): AggregateCurrencies
    {
        if (is_null(self::$currencies)) {
            static::$currencies = static::loadCurrencies();
        }

        return self::$currencies;
    }

    /**
     * @return array
     */
    private static function getCustomCurrencies(): array
    {
        return config('money.currencies', []);
    }

    /**
     * @return AggregateCurrencies
     */
    private static function loadCurrencies(): AggregateCurrencies
    {
        $currenciesList = [
            new ISOCurrencies(),
            new BitcoinCurrencies(),
        ];

        if ($customCurrencies = static::getCustomCurrencies()) {
            $currenciesList[] = new CurrencyList($customCurrencies);
        }

        return new AggregateCurrencies($currenciesList);
    }

    /**
     * @return \Money\Money
     */
    public function getMoney()
    {
        return $this->money;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        $formatter = new DecimalMoneyFormatter(Money::getCurrencies());

        return (float) $formatter->format($this->money);
    }

    /**
     * @return string
     */
    public function getCurrencyCode()
    {
        return $this->money->getCurrency()->getCode();
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->jsonSerialize();
    }

    /**
     * @param int $options
     * @return false|string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }

    /**
     * @return string
     */
    public function render()
    {
        return $this->format();
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'amount' => $this->getAmount(),
            'currency' => $this->getCurrencyCode(),
        ];
    }
}
