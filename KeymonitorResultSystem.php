<?php // vim:set ts=4 sw=4 et:
/**
 * System result
 *
 * @author Raymond Julin 
 * @package Keymonitor
 */

class KeymonitorResultSystem extends KeymonitorResult {
    public $load=array(),$users;
    public function __construct($load, $users) {
        $this->load = $load;
        $this->users = $users;
    }
}
