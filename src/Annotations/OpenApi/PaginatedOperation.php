<?php

declare(strict_types=1);

namespace Annotations\OpenApi;

use Nelmio\ApiDocBundle\Annotation\Operation;
use Swagger\Annotations\Parameter;

/**
 * @Annotation()
 */
class PaginatedOperation extends Operation
{
    /**
     * Paginated constructor.
     *
     * @param mixed[] $properties
     */
    public function __construct(array $properties)
    {
        if (!\is_array($properties['value'])) {
            $object = $properties['value'];
            $properties['value'] = [];
            $properties['value'][] = $object;
        }

        $properties['value'][] = new Parameter(
            [
                'name'        => 'page',
                'in'          => 'query',
                'description' => 'Page number',
                'required'    => false,
                'type'        => 'integer',
            ]
        );

        $properties['value'][] = new Parameter(
            [
                'name'        => 'limit',
                'in'          => 'query',
                'description' => 'Items per page',
                'required'    => false,
                'type'        => 'integer',
            ]
        );
        parent::__construct($properties);
    }
}
