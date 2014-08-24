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
use PhpParser\Parser;

class Core
{
    public $loader;
    public $parser;

    /**
     * Set-up and configure Foxhound.
     */
    public function __construct()
    {
        // Load Composer dependencies.
        $this->loader = require __DIR__ . '/../vendor/autoload.php';

        // Create a new instance of PHP Parser.
        $this->parser = new Parser(new Lexer);
    }
}
