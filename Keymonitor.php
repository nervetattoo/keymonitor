<?php // vim:set ts=4 sw=4 et:
require_once 'KeymonitorInterfaces.php';
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
        $this->registerMediator('http', new KeymonitorHTTP());
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
}

/**
 * Test against http resources
 */
class KeymonitorHTTP extends KeymonitorMediator {
    private $codes = array(
        'redirect' => array(300,301,302,303,307),
        'ok' => array(200,201,202,203,205,206,207),
        'exists' => array(0,404,408,410)
    );
    /**
     * Verify that a web service exists
     * 404 and non existant domains are considered non existant
     *
     * @return boolean
     * @param string $uri
     */
    public function __call($method, $args) {
        $this->start();
        $url = $args[0];
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_TIMEOUT, 15);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
        curl_exec($curl);
        $response = curl_getinfo($curl);
        curl_close($curl);
        // Store result object
        $this->result(new KeymonitorHTTPResult($response['download_content_length'],
            $response['content_type'],$response['http_code']));
        /**
         * Different actions for different method requests
         */
        switch ($method) {
            case 'ok':
                return in_array($this->result()->code, $this->codes['ok']);
                break;
            case 'redirect':
                return in_array($this->result()->code, $this->codes['redirect']);
                break;
            case 'exists':
                return !in_array($this->result()->code, $this->codes['exists']);
                break;
        }
    }
}
class KeymonitorHTTPResult extends KeymonitorResult {
    public $size, $contentType, $code;
    function __construct($size,$contentType,$code) {
        $this->size = $size;
        $this->contentType = $contentType;
        $this->code = $code;
    }
}
