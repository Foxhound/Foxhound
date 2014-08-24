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

use PhpParser\Error;
use PhpParser\NodeTraverser;
use PhpParser\Parser;
use RecursiveDirectoryIterator;

class File
{
    public function __construct(Parser $parser, NodeTraverser $traverser)
    {
        $this->parser = $parser;
        $this->traverser = $traverser;
    }

    public function load($directory = __DIR__)
    {

        // iterate over all .php files in the directory
        $files = new \RecursiveDirectoryIterator($directory);
        $files = new \RecursiveIteratorIterator($files, \RecursiveIteratorIterator::LEAVES_ONLY);
        $files = new \RegexIterator($files, '(\.' . preg_quote('php') . '$)');

        foreach ($files as $file) {
            try {
                echo $file . PHP_EOL;

                // load
                $code = file_get_contents($file);

                // parse
                $stmts = $this->parser->parse($code);

                // traverse
                $this->traverser->traverse($stmts);
            } catch (Error $e) {
                echo 'Parse Error: ', $e->getMessage();
            }
        }
    }
}
