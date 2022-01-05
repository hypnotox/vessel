<?php

declare(strict_types=1);

namespace Tests;

use HypnoTox\Vessel\Container;
use HypnoTox\Vessel\Exception\ContainerException;
use HypnoTox\Vessel\Exception\NotFoundException;

class ContainerTest extends BaseTest
{
    public function testCanConstructAndGetServices(): void
    {
        $services = ['std' => \stdClass::class];
        $container = new Container($services);

        $this->assertSame($services, $container->getServices());
    }

    public function testConstructThrowsIfServiceIdsAreNotStrings(): void
    {
        $this->expectException(ContainerException::class);
        new Container([3 => \stdClass::class]);
    }

    public function testSetServices(): void
    {
        $services = ['std' => \stdClass::class];
        $container = new Container();
        $container->setServices($services);

        $this->assertSame($services, $container->getServices());
    }

    public function testSetServicesThrowsIfServiceIdsAreNotStrings(): void
    {
        $container = new Container();

        $this->expectException(ContainerException::class);
        $container->setServices([3 => \stdClass::class]);
    }

    public function testSetAndGet(): void
    {
        $container = new Container();
        $container->set('std', \stdClass::class);

        $this->assertSame(\stdClass::class, $container->get('std'));
    }

    public function testGetThrowsIfIdIsNotSet(): void
    {
        $container = new Container();

        $this->expectException(NotFoundException::class);
        $container->get('std');
    }

    public function testHas(): void
    {
        $container = new Container(['std' => \stdClass::class]);

        $this->assertTrue($container->has('std'));
        $this->assertFalse($container->has('something.else'));
    }
}
