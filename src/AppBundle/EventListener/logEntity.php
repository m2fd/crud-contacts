<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 16/02/16
 * Time: 01:40.
 */

namespace AppBundle\EventListener;

use AppBundle\Entity\Personne;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

/**
 * Class logEntity
 *
 * Not used as it never worked. Planned us was to log entity status and modification to debug.
 *
 * @package AppBundle\EventListener
 */
class logEntity
{
    /**
     * @param LifecycleEventArgs $args
     */
    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        // only act on some "Product" entity
        if (!$entity instanceof Personne) {
            return;
        }

        $entityManager = $args->getEntityManager();
        // ... do something with the Product
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        // only act on some "Product" entity
        if (!$entity instanceof Personne) {
            return;
        }

        $entityManager = $args->getEntityManager();
        // ... do something with the Product
        $logger = $this->get('logger');
        $logger->addDebug('Doctrine event: personne: '.($entity->getStatus()));
    }
}
