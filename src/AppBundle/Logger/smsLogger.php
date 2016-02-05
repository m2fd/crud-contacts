<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28/01/16
 * Time: 15:28
 */

namespace AppBundle\Logger;


class smsLogger implements Logger
{
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->$logger = $logger;
    }

    public function log($message){
        (new \Sms('06XXXXX', $message))->send();
    }
}