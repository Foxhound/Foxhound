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

use Foxhound\Module\ExampleModule;
use PhpParser\Error;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor\NameResolver;
use PhpParser\Parser;
use Psr\Log\LoggerInterface;
use RecursiveDirectoryIterator;

class File
{
    public function __construct(LoggerInterface $logger, Parser $parser, NodeTraverser $traverser)
    {
        $this->logger = $logger;
        $this->parser = $parser;
        $this->traverser = $traverser;
    }

    public function load($directory = __DIR__)
    {
        $this->traverser->addVisitor(new NameResolver); // we will need resolved names
        $this->traverser->addVisitor(new ExampleModule($this->logger));     // our own node visitor

        // iterate over all .php files in the directory
        $files = new \RecursiveDirectoryIterator($directory);
        $files = new \RecursiveIteratorIterator($files, \RecursiveIteratorIterator::LEAVES_ONLY);
        $files = new \RegexIterator($files, '(\.' . preg_quote('php') . '$)');

        foreach ($files as $file) {
            try {
                // load
                $this->logger->info("Opening file", array("$file"));
                $code = file_get_contents($file);

                // parse
                $this->logger->info("Parsing file", array("$file"));
                $stmts = $this->parser->parse($code);

                // traverse
                $this->logger->info("Traversing file", array("$file"));
                $stmts = $this->traverser->traverse($stmts);
            } catch (Error $e) {
                $this->logger->error('Parse Error', array($e->getMessage()));
            }
        }
    }
}
