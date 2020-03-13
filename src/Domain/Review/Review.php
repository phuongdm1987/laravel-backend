<?php
declare(strict_types=1);

namespace Henry\Domain\Review;

use Henry\Domain\Product\Product;
use Henry\Domain\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Nova\Actions\Actionable;

/**
 * Class Review
 * @property int id
 * @property int reviewer_id
 * @property int product_id
 * @property string title
 * @property string content
 * @property int rate
 * @package Henry\Domain\Review
 */
class Review extends Model
{
    use Actionable;

    protected $with = ['reviewer', 'product'];
    protected $fillable = ['reviewer_id', 'product_id', 'title', 'content', 'rate'];

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getReviewerId(): int
    {
        return $this->reviewer_id;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->product_id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return int
     */
    public function getRate(): int
    {
        return $this->rate;
    }

    /**
     * @return BelongsTo
     */
    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    /**
     * @return BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
