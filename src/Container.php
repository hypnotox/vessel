<?php

declare(strict_types=1);

namespace HypnoTox\Vessel;

use HypnoTox\Vessel\Exception\ContainerException;
use HypnoTox\Vessel\Exception\NotFoundException;

class Container implements ContainerInterface
{
    /**
     * @param array<string, mixed> $services
     *
     * @throws ContainerException
     */
    public function __construct(
        private array $services = [],
    ) {
        $this->ensureIdsAreStrings($this->services);
    }

    public function getServices(): array
    {
        return $this->services;
    }

    /**
     * @param array<string, mixed> $services
     *
     * @throws ContainerException
     */
    public function setServices(array $services): void
    {
        $this->ensureIdsAreStrings($services);

        $this->services = $services;
    }

    public function set(string $id, mixed $service): void
    {
        $this->services[$id] = $service;
    }

    /*
     * Container Interface
     */

    public function get(string $id): mixed
    {
        return $this->has($id) ? $this->services[$id] : throw new NotFoundException(
            sprintf(
                'Service with ID "%s" not found.',
                $id,
            ),
        );
    }

    public function has(string $id): bool
    {
        return isset($this->services[$id]);
    }

    /*
     * Private Methods
     */

    /**
     * @throws ContainerException
     */
    private function ensureIdsAreStrings(array $ids): void
    {
        foreach (array_keys($ids) as $id) {
            if (!\is_string($id)) {
                throw new ContainerException('Service IDs must be strings.');
            }
        }
    }
}
