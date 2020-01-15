<?php
declare(strict_types=1);

namespace Henry\Domain\Category\ValueObjects\Type;


use Henry\Domain\Category\Exceptions\AbstractCategoryException;

/**
 * Class TypeException
 * @package Henry\Domain\Category\ValueObjects\Type
 */
class TypeException extends AbstractCategoryException
{
    /**
     * @var string
     */
    protected static $detailCode = 'type';

    /**
     * @return string
     */
    public function getField(): string
    {
        return 'type';
    }
}
