<?php

declare(strict_types=1);

namespace HypnoTox\Vessel;

use Psr\Container\ContainerInterface as PsrContainerInterface;

interface ContainerInterface extends PsrContainerInterface
{
    public function set(string $id, mixed $service): void;
}
