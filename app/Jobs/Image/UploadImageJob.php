<?php
declare(strict_types=1);

namespace App\Jobs\Image;

use App\Http\Requests\UploadImageRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\Facades\Image;

/**
 * Class UploadImageJob
 * @package App\Jobs\Image
 */
class UploadImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var UploadedFile
     */
    private $image;

    /**
     * Create a new job instance.
     * @param UploadedFile $image
     */
    public function __construct(UploadedFile $image)
    {
        $this->image = $image;
    }

    /**
     * @param UploadImageRequest $request
     * @return self
     */
    public static function fromRequest(UploadImageRequest $request): self
    {
        return new static(
            $request->image()
        );
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        Image::make($this->image);
    }
}
