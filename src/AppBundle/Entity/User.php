<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * Class User
 * @package AppBundle\Entity
 */
class User extends BaseUser
{
    /**
     * @var $id integer
     */
    protected $id;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}