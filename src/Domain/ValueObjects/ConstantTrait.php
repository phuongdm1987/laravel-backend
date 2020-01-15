<?php
declare(strict_types=1);

namespace Henry\Domain\ValueObjects;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
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

        return Arr::where($constants, function($value, $key) use ($prefix) {
            return Str::startsWith($key, $prefix);
        });
    }
}
