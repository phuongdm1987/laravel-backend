<?php
declare(strict_types=1);

namespace Henry\Domain;


use Cocur\Slugify\Slugify;

/**
 * Trait CustomizeSlugEngine
 * @package Henry\Domain
 */
trait CustomizeSlugEngine
{
    /**
     * @param \Cocur\Slugify\Slugify $engine
     * @param string $attribute
     * @return \Cocur\Slugify\Slugify
     */
    public function customizeSlugEngine(Slugify $engine, $attribute): Slugify
    {
        $engine->activateRuleSet('vietnamese');

        return $engine;
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
                'source' => $this->slugSource ?? 'name'
            ]
        ];
    }
}
