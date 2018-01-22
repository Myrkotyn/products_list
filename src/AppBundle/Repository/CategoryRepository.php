<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Category;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

class CategoryRepository extends NestedTreeRepository
{
    public function childrenDQL()
    {
        $qb = $this->createQueryBuilder('c');

        return $qb
            ->select('c.id')
            ->from(Category::class, 'parent')
            ->andWhere($qb->expr()->between('c.lft', 'parent.lft', 'parent.rgt'))
            ->andWhere($qb->expr()->eq('parent.id', ':categoryId'))
            ->orderBy('c.lft')
            ->getDQL();
    }
}