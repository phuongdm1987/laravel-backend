<?php
declare(strict_types=1);

namespace Henry\Domain\ValueObjects;

use ReflectionClass;
use ReflectionException;

/**
 * Trait ConstantTrait
 * @package Henry\Domain\ValueObjects
 */
trait ConstantTrait
{
    /**
     * @param string $prefix
     * @return array
     */
    protected static function getAllConstants(string $prefix = 'TYPE_'): array
    {
        try {
            $refClass = new ReflectionClass(__CLASS__);
        } catch (ReflectionException $e) {
            return [];
        }
        $constants = $refClass->getConstants();

        return array_where($constants, function($value, $key) use ($prefix) {
            return starts_with($key, $prefix);
        });
    }
}
