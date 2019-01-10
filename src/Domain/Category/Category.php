<?php
declare(strict_types=1);

namespace Henry\Domain\Category;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Cviebrock\EloquentSluggable\Sluggable;
use Henry\Domain\Category\ValueObjects\Type\Type;
use Henry\Domain\Category\ValueObjects\Type\TypeException;
use Henry\Domain\CustomizeSlugEngine;
use Illuminate\Database\Eloquent\Model;
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

    public const TYPE_MENU = 'menu';
    public const TYPE_CATEGORY = 'category';

    public $timestamps = false;
    protected $fillable = ['name', 'parent_id', 'type'];

    /**
     * Clone the model into a new, non-existing instance.
     *
     * @param  array|null  $except
     * @return static
     */
    public function replicate(array $except = null)
    {
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
     * @return string
     * @throws TypeException
     */
    public function getType(): string
    {
        $type = new Type();
        $type->setType($this->type);

        return (string)$type;
    }
}
