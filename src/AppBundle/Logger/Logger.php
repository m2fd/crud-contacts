<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28/01/16
 * Time: 15:33.
 */

namespace AppBundle\Logger;

/**
 * Interface Logger
 * @package AppBundle\Logger
 */
interface Logger
{
    /**
     * @param $message
     * @return mixed
     */
    public function log($message);
}
