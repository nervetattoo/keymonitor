<?php // vim:set ts=4 sw=4 et:
/**
 * Provide HTTP monitoring/testing
 *
 * @author Raymond Julin 
 * @package Keymonitor
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
