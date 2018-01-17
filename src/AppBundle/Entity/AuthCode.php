<?php

namespace AppBundle\Entity;

use FOS\OAuthServerBundle\Entity\AuthCode as BaseAuthCode;

/**
 * Class AuthCode
 * @package AppBundle\Entity
 */
class AuthCode extends BaseAuthCode
{
    /**
     * @var $id integer
     */
    protected $id;

    /**
     * @var $client Client
     */
    protected $client;

    /**
     * @var $user User
     */
    protected $user;
}