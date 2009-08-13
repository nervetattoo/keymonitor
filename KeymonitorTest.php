<?php // vim:set ts=4 sw=4 et:
require_once("autoload.php");

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

    /**
     * Test HTTP availability
     */
    public function testHTTPServiceIsUp() {
        $m = new Keymonitor;
        $url = 'http://google.com';
        $url2 = 'http://thiscantpossiblyexistsno.com';
        $url2 = 'http://www.google.com/givememy404pwettyplease';
        $this->assertTrue($m->http->exists($url));
        $this->assertFalse($m->http->exists($url2));
        $this->assertFalse($m->http->exists($url3));
    }
    public function testHTTPOk() {
        // Test for http code 200 etc
        $m = new Keymonitor;
        $url = 'http://www.vg.no';
        $this->assertTrue($m->http->ok($url));
    }
    public function testHTTPRedirect() {
        $m = new Keymonitor;
        $url = 'http://google.com';
        $this->assertTrue($m->http->redirect($url));
    }
    public function testHTTPAcceptableResponseTime() {
        $m = new Keymonitor;
        $url = 'http://raymondjulin.com';
        $this->assertTrue($m->http->respondWithinTime($url, 0.5));
        $this->assertFalse($m->http->respondWithinTime($url, 0.001));
    }

    /**
     * Check system health
     */
    public function testSystemLoad() {
        $m = new Keymonitor;
        // Test that load is under 0.5
        $this->assertTrue($m->system->load(2.5));
        $this->assertFalse($m->system->load(0.000001));
    }
}
