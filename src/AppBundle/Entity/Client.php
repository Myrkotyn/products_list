<?php

namespace AppBundle\Entity;

use FOS\OAuthServerBundle\Entity\Client as BaseClient;

/**
 * Class Client
 * @package AppBundle\Entity
 */
class Client extends BaseClient
{
    /**
     * @var $id integer
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
    }
}