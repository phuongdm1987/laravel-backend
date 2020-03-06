<?php
declare(strict_types=1);

namespace Henry\Domain\User\ValueObjects;


use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

/**
 * Class ProfileId
 * @package Henry\Domain\User\ValueObjects
 */
class ProfileId
{
    public const PROFILE_NORMAL = 1;
    public const PROFILE_ADMIN = 666;
    public const PROFILE_SUPER_ADMIN = 777;

    /**
     * @var int
     */
    private $profileId;

    /**
     * Type constructor.
     * @param int $profileId
     */
    public function __construct(int $profileId)
    {
        $this->profileId = $this->assertProfileId($profileId);
    }

    /**
     * @return array
     */
    public static function getAll(): array
    {
        return [
            self::PROFILE_NORMAL => 'Normal',
            self::PROFILE_ADMIN => 'Admin',
            self::PROFILE_SUPER_ADMIN => 'Super Admin',
        ];
    }

    /**
     * @return bool
     */
    public function isSuperAdmin(): bool
    {
        return $this->profileId === self::PROFILE_SUPER_ADMIN;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->profileId === self::PROFILE_ADMIN;
    }

    /**
     * @param int $profileId
     * @return int
     */
    private function assertProfileId(int $profileId): int
    {
        $isExist = Arr::where(self::getAll(), function ($value, $key) use ($profileId) {
            return $profileId === $key;
        });

        if (!$isExist) {
            throw ValidationException::withMessages([
                'type' => [__('validation.in', ['attribute' => 'profile_id'])],
            ]);
        }

        return $profileId;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->profileId;
    }
}
