<?php // vim:set ts=4 sw=4 et:
require_once("autoload.php");

/**
 * An oversimplified testcase for keymonitor
 *
 * @author Raymond Julin 
 * @package Keymonitor
 */

class KeymonitorTestSuite extends PHPUnit_Framework_TestCase {
    public function testSomethingMoreComplex() {
        $m = new Keymonitor;
        $m->registerMediator('mock', new KeymonitorMediatorMock());
        // Build a monitoring suite where everything must succeed
        $suite = $m->suite()
            ->true($m->mock->true(), 'Test 1 failed')
            ->true($m->mock->true(), 'Test 2 failed');
        $this->assertTrue($suite->result());
        $suite = $m->suite()
            ->true($m->mock->false(), 'Test 1 failed')
            ->false($m->mock->true(), 'Test 2 failed');
        $this->assertFalse($suite->result());
    }
}
