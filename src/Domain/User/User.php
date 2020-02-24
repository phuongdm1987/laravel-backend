<?php
declare(strict_types=1);

namespace Henry\Domain\User;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Nova\Actions\Actionable;
use Laravel\Passport\HasApiTokens;

/**
 * Class User
 * @property int id
 * @property string name
 * @property string email
 * @property Carbon email_verified_at
 * @property Carbon created_at
 * @property Carbon updated_at
 * @package Henry\Domain\User
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable, Actionable;

    protected $dates = ['email_verified_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return Carbon
     */
    public function getVerifiedAt()
    {
        return $this->email_verified_at;
    }

    /**
     * @return Carbon
     */
    public function getCreatedAt(): Carbon
    {
        return $this->created_at;
    }

    /**
     * @return Carbon
     */
    public function getUpdatedAt(): Carbon
    {
        return $this->updated_at;
    }
}
