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

class logEntity
{
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
