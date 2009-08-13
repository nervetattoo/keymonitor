<?php // vim:set ts=4 sw=4 et:
/**
 * HTTP result
 *
 * @author Raymond Julin 
 * @package Keymonitor
 */

class KeymonitorResultHTTP extends KeymonitorResult {
    public $responseTime, $size, $contentType, $code;
    function __construct($responseTime,$size,$contentType,$code) {
        $this->responseTime = $responseTime;
        $this->size = $size;
        $this->contentType = $contentType;
        $this->code = $code;
    }
}
