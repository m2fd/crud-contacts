<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28/01/16
 * Time: 15:27.
 */

namespace AppBundle\Logger;

class emailLogger implements Logger
{
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->$logger = $logger;
    }

    public function log($message)
    {
        mail('tt@tt.com', 'sujet', $message);
    }
}
