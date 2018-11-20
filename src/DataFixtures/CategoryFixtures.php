<?php
namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $categories = ["Roman", "SF", "BD"];

        foreach ($categories as $category) {
            $cat = new Category();
            $cat->setName($category);
            $manager->persist($cat);
            $this->setReference('category-' . strtolower($category), $cat);
        }

        $manager->flush();
    }
}