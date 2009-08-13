<?php // vim:set ts=4 sw=4 et:
require_once('Keymonitor.php');

/**
 * An oversimplified testcase for keymonitor
 *
 * @author Raymond Julin 
 * @package Keymonitor
 */

class KeymonitorTest extends PHPUnit_Framework_TestCase {
    public function testEnvironment() {
        $this->assertTrue(class_exists('Keymonitor'));
    }

    public function testHTTPServiceIsUp() {
        $m = new Keymonitor;
        $url = 'http://google.com';
        $url2 = 'http://thiscantpossiblyexistsno.com';
        $url2 = 'http://www.google.com/givememy404pwettyplease';
        $this->assertTrue($m->http->exists($url));
        $this->assertFalse($m->http->exists($url2));
        $this->assertFalse($m->http->exists($url3));
    }
    public function testOk() {
        // Test for http code 200 etc
        $m = new Keymonitor;
        $url = 'http://www.vg.no';
        $this->assertTrue($m->http->ok($url));
    }
    public function testRedirect() {
        $m = new Keymonitor;
        $url = 'http://google.com';
        $this->assertTrue($m->http->redirect($url));
    }
}
