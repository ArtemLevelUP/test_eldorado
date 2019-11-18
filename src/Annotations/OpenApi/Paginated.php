<?php

declare(strict_types=1);

namespace Annotations\OpenApi;

use Swagger\Annotations\{Items, Property, Schema};

/**
 * @Annotation()
 */
class Paginated extends Schema
{
    /**
     * @var Items
     */
    public $items;

    /**
     * Paginated constructor.
     *
     * @param mixed[] $properties
     */
    public function __construct(array $properties)
    {
        $items = $properties['items'] ?? null;

        $this->properties = [
            new Property(['property' => 'items', 'type' => 'array', 'items' => $items]),
            new Property(['property' => 'page', 'type' => 'integer']),
            new Property(['property' => 'limit', 'type' => 'integer']),
            new Property(['property' => 'total', 'type' => 'integer']),
        ];

        parent::__construct($properties);
    }
}
