<?php
/**
 * Foxhound Core
 * Static Security Analyser and IDS for PHP
 *
 * This library provides a basis for building abstractions e.g. the IDS package
 *
 * @package Core
 * @author  Liam Anderson <liamja@fastmail.fm>
 * @license MIT
 * @version 0.1.0
 */

namespace Foxhound\Core;

class Core
{
    public $loader;

    public function __construct()
    {
        // Load Composer dependencies
        $this->loader = require 'vendor/autoload.php';
    }
}
