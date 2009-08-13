<?php // vim:set ts=4 sw=4 et:
/**
 * Provide system monitoring
 *
 * @author Raymond Julin 
 * @package Keymonitor
 */
class KeymonitorMediatorSystem extends KeymonitorMediator {
    /**
     * Verify that a web service exists
     *
     * @return boolean
     * @param string $uri
     */
    public function __call($method, $args) {
        $this->start();
        // Fetch system information
        $loggedInUsers = trim(`who | wc -l`);
        // Get load results. Sloooooow
        preg_match("/load average: ([0-9]*\.[0-9]*), ([0-9]*\.[0-9]*), ([0-9]*\.[0-9]*)/", 
            `uptime`, $load);
        array_shift($load);
        $this->result(new KeymonitorResultSystem($load, $loggedInUsers));
        /**
         * Methods that can be run after the request is ran
         */
        switch ($method) {
            case 'load':
                if (isset($args[0]))
                    return ($this->result()->load[0] <= $args[0]);
                else
                    return $this->result()->load[0];
        }
    }
}

