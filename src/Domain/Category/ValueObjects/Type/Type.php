<?php
declare(strict_types=1);

namespace Henry\Domain\Category\ValueObjects\Type;


use Illuminate\Validation\ValidationException;
use ReflectionClass;
use ReflectionException;

/**
 * Class Type
 * @package Henry\Domain\Category\ValueObjects
 */
class Type
{
    public const TYPE_MENU = 'menu';
    public const TYPE_CATEGORY = 'category';

    /**
     * @var string
     */
    private $type;

    /**
     * Type constructor.
     */
    public function __construct()
    {
        $this->type = self::TYPE_MENU;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setType(string $type): self
    {
        $this->type = $this->assertType($type);
        return $this;
    }

    /**
     * @return array
     */
    public static function getAll(): array
    {
        try {
            $refClass = new ReflectionClass(__CLASS__);
        } catch (ReflectionException $e) {
            return [];
        }
        $constants = $refClass->getConstants();

        return array_where($constants, function($value, $key){
            return starts_with($key, 'TYPE_');
        });
    }

    /**
     * @return bool
     */
    public function isCategory(): bool
    {
        return $this->type === self::TYPE_CATEGORY;
    }

    /**
     * @param string $type
     * @return string
     */
    private function assertType(string $type): string
    {
        $isExist = array_where(self::getAll(), function($value, $key) use ($type) {
            return $type === $value;
        });

        if (!$isExist) {
            throw ValidationException::withMessages([
                'type' => [__('validation.in', ['attribute' => 'type'])],
            ]);
        }

        return $type;
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
