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

namespace Foxhound\Core;

use PhpParser\Lexer;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class Core
{
    /**
     * @var Object
     */
    public $loader;

    /**
     * @var Object
     */
    public $parser;

    /**
     * @var ContainerBuilder Inversion of Control container to manage dependencies.
     */
    public $container;

    /**
     * Set-up and configure Foxhound.
     */
    public function __construct()
    {
        // Load Composer dependencies.
        $this->loader = require __DIR__ . '/../vendor/autoload.php';

        // Configure dependencies.
        $this->setup();
    }

    private function setup()
    {
        // Register and load services.
        $this->container = new ContainerBuilder;

        $this->container
            ->register('traverser', '\PhpParser\NodeTraverser');
        $this->container
            ->register('lexer', '\PhpParser\Lexer');
        $this->container
            ->register('parser', '\PhpParser\Parser')
            ->addArgument(new Reference('lexer'));
        $this->container
            ->register('file', '\Foxhound\Core\File')
            ->setArguments(
                [
                    new Reference('parser'),
                    new Reference('traverser')
                ]
            );

        $file = $this->container->get('file');
        $file->load();
    }
}
