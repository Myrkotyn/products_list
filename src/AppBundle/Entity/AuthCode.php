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
     * @var integer
     */
    protected $id;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var User
     */
    protected $user;
}