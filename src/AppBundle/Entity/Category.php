<?php

namespace AppBundle\Entity;

/**
 * Class Category
 * @package AppBundle\Entity
 */
class Category
{
    /**
     * @var $id int
     */
    private $id;

    /**
     * @var $title string
     */
    private $title;

    /**
     * @var $lft integer
     */
    private $lft;

    /**
     * @var $lvl integer
     */
    private $lvl;

    /**
     * @var $rgt integer
     */
    private $rgt;

    /**
     * @var $root integer
     */
    private $root;

    /**
     * @var $parent Category
     */
    private $parent;

    /**
     * @var $children Category
     */
    private $children;

    /**
     * @var $products Product[]
     */
    private $products;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $title
     * @return Category
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param Category|null $parent
     * @return Category
     */
    public function setParent(Category $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Category|null
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle();
    }
}