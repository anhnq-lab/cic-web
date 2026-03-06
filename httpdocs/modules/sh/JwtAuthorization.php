<?php
require '../vendor/autoload.php';
class JwtAuthorization implements Requests_Auth
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function register(Requests_Hooks $hooks)
    {
        $hooks->register('requests.before_request', array($this, 'before_request'));
    }

    public function before_request(&$url, &$headers, &$data, &$type, &$options)
    {
        $headers['Authorization'] = 'Bearer '.$this->token;
    }
}
