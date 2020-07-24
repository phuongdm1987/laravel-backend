<?php
declare(strict_types=1);

namespace Henry\Domain\Voyager;

/**
 * Class VoyagerReader
 * @package Henry\Domain\Voyager
 */
class VoyagerReader extends AbstractVoyager
{
    /**
     * @var bool
     */
    private $isSoftDeleted;

    /**
     * @return bool
     */
    public function isSoftDeleted(): bool
    {
        return $this->isSoftDeleted;
    }

    /**
     * @param bool $isSoftDeleted
     */
    public function setIsSoftDeleted(bool $isSoftDeleted): void
    {
        $this->isSoftDeleted = $isSoftDeleted;
    }
}
