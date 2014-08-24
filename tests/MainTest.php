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
    public function testDoesAutoloadDependencies()
    {
        $core = new Foxhound\Core\Core();
        $this->assertInstanceOf('\Composer\Autoload\ClassLoader', $core->loader);
    }

    public function testDoesCreateServicesUsingIOC()
    {
        $core = new Foxhound\Core\Core();
        $this->assertInstanceOf('\PhpParser\Parser', $core->container->get('parser'));
        $this->assertInstanceOf('\PhpParser\NodeTraverser', $core->container->get('traverser'));
        $this->assertInstanceOf('\Foxhound\Core\File', $core->container->get('file'));
    }
}
