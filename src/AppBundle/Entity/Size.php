<?php

namespace AppBundle\Entity;

class Size extends ProductAttributes
{
    /**
     * @var string $value
     */
    private $value;

    /**
     * @return string
     */
    public function getValue(): ? string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }
}