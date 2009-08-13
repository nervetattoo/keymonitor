<?php // vim:set ts=4 sw=4 et:
/**
 * A mocked up reporter.
 * Just squash the data and say "yes it arrived at me"
 *
 * @author Raymond Julin 
 * @package Keymonitor
 */
class KeymonitorReporterMock extends KeymonitorReporter {
    public function generate() {
        return $this->messages();
    }
}
