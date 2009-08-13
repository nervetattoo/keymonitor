<?php // vim:set ts=4 sw=4 et:
/**
 * Reporter base
 *
 * @author Raymond Julin 
 * @package Keymonitor
 */
abstract class KeymonitorReporter {
    $this->messages = array();
    
    /**
     * Accept a new message and keep it in the stack
     *
     * @return void
     * @param string $message
     */
    public function push($message) {
        $this->messages[] = $message;
    }
    
    /**
     * Clean up message stack
     *
     * @return void
     */
    public function clean() {
        $this->messages = array();
    }
    
    /**
     * Return message stack
     *
     * @return array
     */
    protected function messages() {
        return $this->messages;
    }
    
    /**
     * Generate/run report
     *
     * @return mixed
     */
    public function generate();
}
