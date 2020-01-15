<?php
declare(strict_types=1);

namespace Henry\Domain\ValueObjects;

/**
 * Class Order
 * @package Henry\Domain\ValueObjects
 */
class Order
{
    use ConstantTrait;

    public const TYPE_ASC = 'asc';
    public const TYPE_DESC = 'desc';

    /**
     * @var string
     */
    private $field;
    /**
     * @var string
     */
    private $direction;

    /**
     * Order constructor.
     * @param string $field
     * @param string $direction
     */
    public function __construct(string $field, string $direction = 'asc')
    {
        $this->field = $field;
        $this->direction = $this->validate($direction);
    }

    /**
     * @return string
     */
    public function getField(): string
    {
        return $this->field;
    }

    /**
     * @return string
     */
    public function getDirection(): string
    {
        return $this->direction;
    }

    /**
     * @param string $direction
     * @return string
     */
    private function validate(string $direction): string
    {
        $types = self::getTypes();
        return \in_array($direction, $types, true) ? $direction : 'asc';
    }

    /**
     * @return array
     */
    public static function getTypes(): array
    {
        return self::getAllConstants();
    }
}
