<?php
/**
 * @author Liam
 */

namespace Foxhound\Module;

use Foxhound\Core\Module;
use PhpParser\Node;

class ExampleModule extends Module
{
    protected $message = 'Use of eval()';

    public function leaveNode(Node $node)
    {
        if ($node instanceof Node\Expr\Eval_) {
            var_dump($node->getLine());
            $this->line = $node->getLine();
            $this->file = __FILE__;
            $this->log();
            $this->
        }
    }
}
