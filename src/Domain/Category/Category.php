<?php
declare(strict_types=1);

namespace Henry\Domain\Category;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Cviebrock\EloquentSluggable\Sluggable;
use Henry\Domain\Category\ValueObjects\Type\Type;
use Henry\Domain\Category\ValueObjects\Type\TypeException;
use Henry\Domain\CustomizeSlugEngine;
use Henry\Domain\Product\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kalnoy\Nestedset\NodeTrait;

/**
 * Class Category
 * @package Henry\Domain\Category
 */
class Category extends Model
{
    use Sluggable, CustomizeSlugEngine , NodeTrait {
        NodeTrait::replicate as replicateNode;
        Sluggable::replicate as replicateSlug;
    }

    public $timestamps = false;
    protected $fillable = ['name', 'parent_id', 'type'];
    protected $with = ['children'];

    /**
     * @param array|null $except
     * @return Model
     */
    public function replicate(array $except = null): Model
    {
        parent::replicate($except);

        $instance = $this->replicateNode($except);
        (new SlugService())->slug($instance, true);

        return $instance;
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
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return Type
     * @throws TypeException
     */
    public function getType(): Type
    {
        $type = new Type();
        $type->setType($this->type);

        return $type;
    }

    /**
     * @return bool
     * @throws TypeException
     */
    public function isTypeCategory(): bool
    {
        return $this->getType()->isCategory();
    }

    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
