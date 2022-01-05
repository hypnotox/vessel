<?php

declare(strict_types=1);

namespace HypnoTox\Vessel\Exception;

use Psr\Container\NotFoundExceptionInterface;

class NotFoundException extends \Exception implements NotFoundExceptionInterface
{
}
