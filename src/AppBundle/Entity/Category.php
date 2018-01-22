<?php

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @var $products ArrayCollection|Product[]
     */
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle();
    }

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
     * @param Product $product
     * @return Category|null $this
     */
    public function addProduct(Product $product): ? Category
    {
        if ($this->products->contains($product)) {
            return null;
        }

        $this->products->add($product);
        $product->addCategory($this);

        return $this;
    }

    /**
     * @param Product $product
     */
    public function removeProduct(Product $product)
    {
        if (!$this->products->contains($product)) {
            return;
        }

        $this->products->remove($product);
        $product->removeCategory($this);
    }
}