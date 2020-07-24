<?php
declare(strict_types=1);

namespace Henry\Domain\Voyager;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Models\DataType;

/**
 * Class AbstractVoyager
 * @package Henry\Domain\Voyager
 */
abstract class AbstractVoyager
{
    /**
     * @var string
     */
    private $view;
    /**
     * @var DataType
     */
    private $dataType;
    /**
     * @var Model
     */
    private $dataTypeContent;
    /**
     * @var bool
     */
    private $isModelTranslatable;

    /**
     * VoyagerEditor constructor.
     * @param string $view
     */
    public function __construct(string $view)
    {
        $this->view = $view;
    }

    /**
     * @return string
     */
    public function getView(): string
    {
        return $this->view;
    }

    /**
     * @return DataType
     */
    public function getDataType(): DataType
    {
        return $this->dataType;
    }

    /**
     * @param DataType $dataType
     */
    public function setDataType(DataType $dataType): void
    {
        $this->dataType = $dataType;
    }

    /**
     * @return Model
     */
    public function getDataTypeContent(): Model
    {
        return $this->dataTypeContent;
    }

    /**
     * @param Model $dataTypeContent
     */
    public function setDataTypeContent(Model $dataTypeContent): void
    {
        $this->dataTypeContent = $dataTypeContent;
    }

    /**
     * @return bool
     */
    public function isModelTranslatable(): bool
    {
        return $this->isModelTranslatable;
    }

    /**
     * @param bool $isModelTranslatable
     */
    public function setIsModelTranslatable(bool $isModelTranslatable): void
    {
        $this->isModelTranslatable = $isModelTranslatable;
    }
}
