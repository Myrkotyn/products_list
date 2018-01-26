<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;

/**
 * Class Product
 * @package AppBundle\Entity
 */
class Product
{
    /**
     * @var $id integer
     */
    private $id;

    /**
     * @var $name string
     */
    private $name;

    /**
     * @var $price float
     */
    private $price;

    /**
     * @var ArrayCollection $categories
     */
    private $categories;

    /**
     * Product attributes
     *
     * @var ProductAttributes
     */
    private $attributes;

    /**
     * @var Category $category
     */
    private $category;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->attributes = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }
    
    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Product
     */
    public function setName($name): ? Product
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return Product
     */
    public function setPrice($price): ? Product
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return ArrayCollection|null
     */
    public function getCategories(): ? ArrayCollection
    {
        return $this->categories;
    }

    /**
     * @param Category $category
     * @return Product|null
     */
    public function addCategory(Category $category): ? Product
    {
        if ($this->categories->contains($category)) {
            return null;
        }

        $this->categories->add($category);
        $category->addProduct($this);

        return $this;
    }

    /**
     * @param Category $category
     */
    public function removeCategory(Category $category)
    {
        if (!$this->categories->contains($category)) {
            return;
        }

        $this->categories->remove($category);
        $category->removeProduct($this);
    }

    /**
     * @return ArrayCollection|null
     */
    public function getAttributes(): ? ArrayCollection
    {
        return $this->attributes;
    }

    /**
     * @param ProductAttributes $attribute
     * @return $this|null
     */
    public function addAttribute(ProductAttributes $attribute)
    {
        if ($this->attributes->contains($attribute)) {
            return null;
        }

        $this->attributes->add($attribute);
        $attribute->setProduct($this);

        return $this;
    }

    /**
     * @param ProductAttributes $attribute
     */
    public function removeAttribute(ProductAttributes $attribute)
    {
        if (!$this->attributes->contains($attribute)) {
            return;
        }

        $this->attributes->remove($attribute);
    }
}