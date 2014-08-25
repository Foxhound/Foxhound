<?php

/**
 * Foxhound Core
 * Static Security Analyser and IDS for PHP
 *
 * This library provides a basis for building abstractions e.g. the IDS package.
 *
 * @package Core
 * @author  Liam Anderson <liamja@fastmail.fm>
 * @license MIT
 * @version 0.1.0
 */
class MainTest extends PHPUnit_Framework_TestCase
{
    public function __construct()
    {
        $this->core = new \Foxhound\Core\Core();
    }

    public function testDoesAutoloadDependencies()
    {
        $this->assertInstanceOf(
            '\Composer\Autoload\ClassLoader',
            $this->core->loader
        );
    }

    /**
     * @depends testDoesAutoloadDependencies
     */
    public function testDoesServeDependenciesUsingIOC()
    {
        $this->assertInstanceOf(
            '\PhpParser\Parser',
            $this->core->container->get('parser')
        );
        $this->assertInstanceOf(
            '\PhpParser\NodeTraverser',
            $this->core->container->get('traverser')
        );
        $this->assertInstanceOf(
            '\Foxhound\Core\File',
            $this->core->container->get('file')
        );
    }
}
