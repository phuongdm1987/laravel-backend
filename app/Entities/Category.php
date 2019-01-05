<?php
declare(strict_types=1);

namespace App\Entities;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

/**
 * Class Category
 *
 * @package App\Entities
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $_lft
 * @property int $_rgt
 * @property int|null $parent_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category whereLft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category whereRgt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category whereSlug($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    use Sluggable , NodeTrait {
        NodeTrait::replicate as replicateNode;
        Sluggable::replicate as replicateSlug;
    }

    public const TYPE_MENU = 'menu';
    public const TYPE_CATEGORY = 'category';

    public $timestamps = false;

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
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
