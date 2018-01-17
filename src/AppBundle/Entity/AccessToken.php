<?php

namespace AppBundle\Entity;

use FOS\OAuthServerBundle\Entity\AccessToken as BaseAccessToken;

/**
 * Class AccessToken
 * @package AppBundle\Entity
 */
class AccessToken extends BaseAccessToken
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