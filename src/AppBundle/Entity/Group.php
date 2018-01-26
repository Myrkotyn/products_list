<?php

namespace AppBundle\Entity;

/**
 * Class Group
 * @package AppBundle\Entity
 */
class Group extends ProductAttributes
{
    /**
     * @var GroupType
     */
    private $group;

    /**
     * @return GroupType
     */
    public function getGroup(): ? GroupType
    {
        return $this->group;
    }

    /**
     * @param GroupType $group
     * @return Group
     */
    public function setGroup(GroupType $group): ? Group
    {
        $this->group = $group;

        return $this;
    }
}