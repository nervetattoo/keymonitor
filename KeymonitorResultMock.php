<?php // vim:set ts=4 sw=4 et:
/**
 * Mock result
 *
 * @author Raymond Julin 
 * @package Keymonitor
 */

class KeymonitorResultMock extends KeymonitorResult {
    public $method,$data;
    function __construct($method,$data) {
        $this->method = $method;
        $this->data = $data;
    }
}

