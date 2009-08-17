<?php // vim:set ts=4 sw=4 et:
/**
 * Reporter base
 *
 * @author Raymond Julin 
 * @package Keymonitor
 */
abstract class KeymonitorReporter {
    protected $messages = array();
    
    /**
     * Accept a message to the report
     *
     * @return void
     * @param string $message
     */
    public function attach($message) {
        $this->messages[] = $message;
    }
    
    /**
     * Generate/run report
     *
     * @return mixed
     */
    abstract public function generate();
}
