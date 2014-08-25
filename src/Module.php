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

use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;
use Psr\Log\LoggerInterface;

class Module extends NodeVisitorAbstract
{
    protected $line;
    protected $file;
    protected $message = "UNDEFINED";
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function log()
    {
        $this->logger->alert(
            $this->message,
            array(
                "File" => $this->file,
                "Line" => $this->line,
                "Module" => array(__FILE__)
            )
        );
    }
}
