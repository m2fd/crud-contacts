<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28/01/16
 * Time: 15:27.
 */

namespace AppBundle\Logger;

/**
 * Class emailLogger
 * @package AppBundle\Logger
 */
class emailLogger implements Logger
{
    private $logger;

    /**
     * emailLogger constructor.
     * @param Logger $logger
     */
    public function __construct(Logger $logger)
    {
        $this->$logger = $logger;
    }

    /**
     * function log send a message through email
     * @param $message
     * @return mixed|void
     */
    public function log($message)
    {
        mail('tt@tt.com', 'sujet', $message);
    }
}
