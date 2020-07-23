<?php
declare(strict_types=1);

namespace Henry\Domain\Attribute\ValueObjects;

use Henry\Domain\ValueObjects\ConstantTrait;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

/**
 * Class DataType
 * @package Henry\Domain\Attribute\ValueObjects
 */
class DataType
{
    use ConstantTrait;

    public const TYPE_INTEGER = 1;
    public const TYPE_FLOAT = 2;
    public const TYPE_STRING = 3;

    public static $types = [
        self::TYPE_INTEGER => 'Integer',
        self::TYPE_FLOAT => 'Float',
        self::TYPE_STRING => 'String',
    ];

    /**
     * @var string
     */
    private $type;

    /**
     * Type constructor.
     * @param int $type
     * @throws ValidationException
     */
    public function __construct(int $type)
    {
        $this->type = $this->assertType($type);
    }

    /**
     * @param int $type
     * @return string
     * @throws ValidationException
     */
    private function assertType(int $type): string
    {
        $isExist = Arr::where(self::$types, static function ($value, $key) use ($type) {
            return $type === $key;
        });

        if (!$isExist) {
            throw ValidationException::withMessages([
                'data_type' => [__('validation.in', ['attribute' => 'data_type'])],
            ]);
        }

        return self::$types[$type];
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->type;
    }
}
