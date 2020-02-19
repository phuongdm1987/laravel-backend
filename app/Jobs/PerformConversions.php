<?php
declare(strict_types=1);

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\MediaLibrary\Conversion\ConversionCollection;
use Spatie\MediaLibrary\FileManipulator;
use Spatie\MediaLibrary\Models\Media;

/**
 * Class PerformConversions
 * @package App\Jobs
 */
class PerformConversions implements ShouldQueue
{
    use InteractsWithQueue, Queueable;

    /** @var \Spatie\MediaLibrary\Conversion\ConversionCollection */
    protected $conversions;

    /** @var \Spatie\MediaLibrary\Models\Media */
    protected $media;

    /** @var bool */
    protected $onlyMissing;

    /**
     * PerformConversions constructor.
     * @param ConversionCollection $conversions
     * @param Media $media
     * @param bool $onlyMissing
     */
    public function __construct(ConversionCollection $conversions, Media $media, $onlyMissing = false)
    {
        $this->conversions = $conversions;

        $this->media = $media;

        $this->onlyMissing = $onlyMissing;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        app(FileManipulator::class)->performConversions($this->conversions, $this->media, $this->onlyMissing);

        return true;
    }
}
