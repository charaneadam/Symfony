<?php
/**
 * Created by PhpStorm.
 * User: adam
 * Date: 4/30/2018
 * Time: 2:57 PM
 */

namespace OC\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OC\PlatformBundle\Entity\Category;


class LoadCategory implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.

        $names = array('Développement Web', 'Développement mobile', 'Graphisme', 'Réseaux', 'Intégration');
        foreach ($names as $name){
            $category = new Category();
            $category->setName($name);
            $manager->persist($category);
        }

        $manager->flush();
    }
}