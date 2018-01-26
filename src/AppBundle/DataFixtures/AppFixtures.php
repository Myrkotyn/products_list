<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Category;
use AppBundle\Entity\GroupType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $objectManager)
    {
        $this->createGroupTypes($objectManager);
        $this->createCategories($objectManager);
        $objectManager->flush();
    }

    private function createGroupTypes(ObjectManager $objectManager)
    {
        for ($i = 0; $i < 4; $i++) {
            $group = new GroupType();
            $group->setId($i);
            $group->setName('Group - '.$i);
            $objectManager->persist($group);
        }
    }

    private function createCategories(ObjectManager $objectManager)
    {
        $phoneCategory = (new Category())
            ->setTitle('Phone');
        $objectManager->persist($phoneCategory);

        $iPhoneCategory = (new Category())
            ->setTitle('iPhone')
            ->setParent($phoneCategory);
        $objectManager->persist($iPhoneCategory);

        $xiaomiCategory = (new Category())
            ->setTitle('Xiaomi')
            ->setParent($phoneCategory);
        $objectManager->persist($xiaomiCategory);
    }
}