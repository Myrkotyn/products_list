<?php

namespace AppBundle\Validator\Constraints;

use AppBundle\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CategoryExistingValidator extends ConstraintValidator
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function validate($value, Constraint $constraint)
    {
        if ($value) {
            $category = $this->em->getRepository(Category::class)->find($value->getId());
            if (!$category) {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ id }}', $value->getId())
                    ->addViolation();
            }
        }
    }
}