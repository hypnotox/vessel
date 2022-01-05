<?php

declare(strict_types=1);

namespace HypnoTox\Vessel;

use HypnoTox\Vessel\Exception\NotFoundException;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    private array $services = [];

    /*
     * Container Interface
     */

    public function get(string $id): mixed
    {
        if (!$this->has($id)) {
            throw new NotFoundException(
                sprintf(
                    'Service with ID "%s" not found.',
                    $id,
                ),
            );
        }

        return $this->services[$id];
    }

    public function has(string $id): bool
    {
        return isset($this->services[$id]);
    }
}
