<?php

namespace AppBundle\Entity\ProductAttributes;

use AppBundle\Entity\ProductAttributes;

class Color extends ProductAttributes
{
    /**
     * @var string $value
     */
    private $value;

    /**
     * @var string $type
     */
    private $type;

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

    /**
     * @return string
     */
    public function getType(): ? string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }
}