<?php
declare(strict_types=1);

namespace Henry\Domain\Product;

use Cviebrock\EloquentSluggable\Sluggable;
use Henry\Domain\CustomizeSlugEngine;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package Henry\Domain\Product
 */
class Product extends Model
{
    use Sluggable, CustomizeSlugEngine;
}
