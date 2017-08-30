<?php

namespace Sensio\Bundle\FrameworkExtraBundle\Tests\Configuration;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @author Iltar van der Berg <ivanderberg@hostnet.nl>
 */
class RouteTest extends \PHPUnit_Framework_TestCase
{
    public function testSetServiceWithoutPath()
    {
        $route = new Route(array());
        $this->assertNull($route->getPath());
        $this->assertNull($route->getService());

        $route->setService('app.bonjour');

        $this->assertSame('', $route->getPath());
        $this->assertSame('app.bonjour', $route->getService());
    }

    public function testSetServiceWithPath()
    {
        $route = new Route(array());
        $this->assertNull($route->getPath());
        $this->assertNull($route->getService());

        $route->setPath('/bonjour/');
        $route->setService('app.bonjour');

        $this->assertSame('/bonjour/', $route->getPath());
        $this->assertSame('app.bonjour', $route->getService());
    }

    public function testSettersViaConstruct()
    {
        $route = new Route(array('service' => 'app.bonjour'));
        $this->assertSame('', $route->getPath());
        $this->assertSame('app.bonjour', $route->getService());

        $route = new Route(array('service' => 'app.bonjour', 'path' => '/bonjour/'));
        $this->assertSame('/bonjour/', $route->getPath());
        $this->assertSame('app.bonjour', $route->getService());
    }
}
