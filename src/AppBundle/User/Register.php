<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28/01/16
 * Time: 14:49.
 */

namespace AppBundle\User;

use Psr\Log\LoggerInterface;

class Register
{
    private $logger;
    //public function __construct(LoggerInterface $logger){
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;

        /*
        $test = 'foo';
        $this->$test = 'truc';
        $this->foo = truc;
        */
    }

    //public function createUser(string $user,string $password){
    public function createUser($user, $password)
    {

        // pb lors des tests ou de changements d'implementation.
        //$logger = new Logger(/* ..*/);
        // pas de dependances explicites
        //$logger = sfConfig::getLogger();

        // injection du logger via l'interface. (seule dépendance)
        //single quote préférable.
        $this->logger->info('User '.$user.' registered.');
        $this->logger->info(sprintf('User "$user" registered.', $user));
        //$this->logger->log(sprintf('User "$user" registered.',$user));
    }
}
