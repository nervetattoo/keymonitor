<?php // vim:set ts=4 sw=4 et:
/**
 * Build a keymonitor suite
 *
 * @author Raymond Julin 
 * @package Keymonitor
 */

class KeymonitorSuite {
    public $tests=array();
    public function __call($method,$data) {
        if ($method=='true')
            $test = true;
        else
            $test = false;
        $this->tests[] = array(
            'result' => ($data[0] == $test),
            'message' => $data[1]);
        return $this;
    }
    public function result() {
        $stat = true;
        foreach ($this->tests as $t) {
            if (!$t['result']) {
                echo $t['message'] . "\n";
                $stat = false;
            }
        }
        return $stat;
    }
}
