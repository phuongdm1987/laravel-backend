<?php
declare(strict_types=1);

namespace App\Jobs\User;

use Henry\Domain\User\Repositories\UserRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Class GetNormalUsersJob
 * @package App\Jobs\Product
 */
class GetNormalUsersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var array
     */
    private $conditions;
    /**
     * @var int
     */
    private $perPage;

    /**
     * Create a new job instance.
     * @param array $conditions
     * @param int $perPage
     */
    public function __construct(array $conditions = [], $perPage = 15)
    {
        $this->conditions = $conditions;
        $this->perPage = $perPage;
    }

    /**
     * Execute the job.
     * @param UserRepositoryInterface $userRepository
     * @return LengthAwarePaginator
     */
    public function handle(UserRepositoryInterface $userRepository): LengthAwarePaginator
    {
        return $userRepository->withPaginate($this->conditions, $this->perPage);
    }
}
