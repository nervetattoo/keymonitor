<?php // vim:set ts=4 sw=4 et:
/**
 * Interfaces for system
 *
 * @author Raymond Julin 
 * @package Keymonitor
 */
abstract class KeymonitorMediator {
    private $time = null;
    private $result = null;
    public function result($obj=null) {
        if ($obj) {
            $this->result = $obj;
            $this->result->time = time() - $this->time;
        }
        return $this->result;
    }
    public function time() {
        return $this->time;
    }
    public function start() {
        $this->time = time();
    }
}
abstract class KeymonitorResult {
    public $time = 0;
}
