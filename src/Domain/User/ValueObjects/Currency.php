<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 28/01/2019
 * Time: 22:40
 */

namespace Henry\Domain\User\ValueObjects;


use Henry\Domain\ValueObjects\ConstantTrait;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

/**
 * Class Currency
 * @package Henry\Domain\User\ValueObjects
 */
class Currency
{
    use ConstantTrait;

    public const TYPE_VND = 'vnđ';
    /**
     * @var float
     */
    private $number;
    /**
     * @var string
     */
    private $currency;
    /**
     * @var string
     */
    private $decPoint;
    /**
     * @var string
     */
    private $thousandsSep;
    /**
     * @var int
     */
    private $decimals;

    /**
     * Currency constructor.
     * @param float $number
     * @param string $currency
     * @param string $decPoint
     * @param string $thousandsSep
     * @param int $decimals
     */
    public function __construct(
        float $number,
        string $currency = self::TYPE_VND,
        string $decPoint = ',',
        string $thousandsSep = '.',
        int $decimals = 0
    )
    {
        $currency = $this->assertCurrency($currency);

        $this->number = $number;
        $this->currency = $currency;
        $this->decPoint = $decPoint;
        $this->thousandsSep = $thousandsSep;
        $this->decimals = $decimals;
    }

    /**
     * @param string $currency
     * @return string
     */
    private function assertCurrency(string $currency): string
    {
        $isExist = Arr::where(self::getAll(), function ($value, $key) use ($currency) {
            return $currency === $value;
        });

        if (!$isExist) {
            throw ValidationException::withMessages([
                'type' => [__('validation.in', ['attribute' => 'currency'])],
            ]);
        }

        return $currency;
    }

    /**
     * @return array
     */
    public static function getAll(): array
    {
        return self::getAllConstants();
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->number;
    }

    /**
     * @return string
     */
    public function format(): string
    {
        if ($this->number <= 0) {
            return __('commons.contact');
        }
        return number_format($this->number, $this->decimals, $this->decPoint, $this->thousandsSep) . $this->currency;
    }
}
