<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 05/02/16
 * Time: 10:23
 */

namespace AppBundle\DBAL;


class EnumStatusType extends EnumType
{
    protected $name = 'enumstatus';
    protected $values = array('professionnel', 'particulier');
}