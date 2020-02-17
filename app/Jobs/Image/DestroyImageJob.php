<?php
declare(strict_types=1);

namespace App\Jobs\Image;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Storage;

/**
 * Class DestroyImageJob
 * @package App\Jobs\Image
 */
class DestroyImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var string
     */
    private $id;

    /**
     * Create a new job instance.
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     * @return void
     */
    public function handle(): void
    {
        Storage::delete(env('UPLOAD_IMAGE_PATH') . $this->id);
    }
}
