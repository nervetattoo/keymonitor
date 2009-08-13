<?php // vim:set ts=4 sw=4 et:
/**
 * HTTP result
 *
 * @author Raymond Julin 
 * @package Keymonitor
 */

class KeymonitorHTTPResult extends KeymonitorResult {
    public $size, $contentType, $code;
    function __construct($size,$contentType,$code) {
        $this->size = $size;
        $this->contentType = $contentType;
        $this->code = $code;
    }
}
