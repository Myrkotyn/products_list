<?php

namespace AppBundle\Entity;

class GroupType
{
    /**
     * @var int $id
     */
    private $id;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @return int
     */
    public function getId(): ? int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return GroupType
     */
    public function setId($id): ? GroupType
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): ? string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return GroupType
     */
    public function setName($name): ? GroupType
    {
        $this->name = $name;

        return $this;
    }
}