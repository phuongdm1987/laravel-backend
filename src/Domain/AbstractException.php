<?php
declare(strict_types=1);

namespace Henry\Domain;


use Exception;

/**
 * Class AbstractException
 * @package Henry\Domain
 */
class AbstractException extends Exception
{
    /**
     * @var string
     */
    protected static $groupCode = 'group';

    /**
     * @var string
     */
    protected static $detailCode = 'detail';

    /**
     * @return string
     */
    public function getErrorCode(): string
    {
        return (static::$groupCode  . '.' . static::$detailCode);
    }
}
