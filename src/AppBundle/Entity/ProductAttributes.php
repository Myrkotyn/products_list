<?php

namespace AppBundle\Entity;

abstract class ProductAttributes
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var Product $product
     */
    private $product;

    /**
     * @return int
     */
    public function getId(): ? int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return Product
     */
    public function getProduct(): ? Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }
}