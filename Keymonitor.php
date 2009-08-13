<?php // vim:set ts=4 sw=4 et:
require_once("autoload.php");
/**
 * A generic PHP monitoring and logging system
 *
 * @author Raymond Julin 
 * @package Keymonitor
 */

class Keymonitor {
    private $mediators = array();
    
    /**
     * Constructor sets up some default mediators
     */
    function __construct() {
        $this->registerMediator('http', new KeymonitorMediatorHTTP());
        $this->registerMediator('system', new KeymonitorMediatorSystem());
    }
    
    /**
     * Register a new mediator to use
     * This allows for easily writing "plugins"
     *
     * @return void
     * @param string $name
     * @param KeymonitorMediator $mediator Mediator object
     */
    public function registerMediator($name, KeymonitorMediator $mediator) {
        $this->mediators[$name] = $mediator;
    }
    
    /**
     * What mediator to call?
     *
     * @return mixed
     * @param string $system
     */
    public function __get($mediator) {
        if ($this->mediators[$mediator])
            return $this->mediators[$mediator];
    }
    public function suite() {
        return new KeymonitorSuite();
    }
}
