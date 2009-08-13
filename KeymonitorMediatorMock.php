<?php // vim:set ts=4 sw=4 et:
/**
 * Mock mediator
 *
 * @author Raymond Julin 
 * @package Keymonitor
 */
class KeymonitorMediatorMock extends KeymonitorMediator {
    public function __call($method,$data) {
        $this->result(new KeymonitorResultMock(
            $method,$data));
        if ($method == 'true')
            return true;
        else
            return false;
    }
}
