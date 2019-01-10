<?php
declare(strict_types=1);

namespace Henry\Domain\Category\Exceptions;


use Henry\Application\Exceptions\AbstractValidationException;

/**
 * Class AbstractCategoryException
 * @package Henry\Domain\Category\Exceptions
 */
abstract class AbstractCategoryException extends AbstractValidationException
{
    /**
     * @var string
     */
    protected static $groupCode = 'advert';
}
