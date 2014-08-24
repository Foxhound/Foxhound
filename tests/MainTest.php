<?php

class MainTest extends PHPUnit_Framework_TestCase
{

    public function testDoesAutoloadDependencies()
    {
        $core = new Foxhound\Core\Core();
        $this->assertNotEmpty($core->loader);
    }

}
