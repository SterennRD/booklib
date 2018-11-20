<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class BookFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $hp_cdf = new Book();
        $hp_cdf->setTitle("Harry Potter et la Coupe de Feu");
        $hp_cdf->setAuthor($this->getReference('author-rowling'));
        $hp_cdf->addCategory($this->getReference('category-roman'));
        $hp_cdf->addCategory($this->getReference('category-sf'));
        $hp_cdf->setImage('hpelcdf.jpg');
        $hp_cdf->setSlug('harry-potter-et-la-coupe-de-feu');
        $manager->persist($hp_cdf);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [CategoryFixtures::class, AuthorFixtures::class];
    }
}
