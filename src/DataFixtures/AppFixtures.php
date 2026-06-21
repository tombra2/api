<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // --- Categories ---
        $categoriesData = [
            ['Fiction', 'fiction'],
            ['Science', 'science'],
            ['History', 'history'],
            ['Programming', 'programming'],
        ];

        $categories = [];
        foreach ($categoriesData as [$name, $slug]) {
            $category = new Category();
            $category->setName($name);
            $category->setSlug($slug);
            $manager->persist($category);
            $categories[] = $category;
        }

        // --- Authors ---
        $authorsData = [
            ['George Orwell', 'English novelist and essayist.', 'United Kingdom'],
            ['Yuval Noah Harari', 'Historian and author of Sapiens.', 'Israel'],
            ['Robert C. Martin', 'Software engineer, author of Clean Code.', 'United States'],
        ];

        $authors = [];
        foreach ($authorsData as [$name, $bio, $country]) {
            $author = new Author();
            $author->setName($name);
            $author->setBio($bio);
            $author->setCountry($country);
            $manager->persist($author);
            $authors[] = $author;
        }

        // --- Books ---
        $booksData = [
            ['1984', '9780451524935', '12.99', '1949-06-08', 42, 0, [0]],
            ['Animal Farm', '9780451526342', '9.99', '1945-08-17', 30, 0, [0]],
            ['Sapiens', '9780062316097', '19.99', '2011-01-01', 55, 2, [1, 2]],
            ['Clean Code', '9780132350884', '34.99', '2008-08-01', 18, 2, [3]],
        ];

        foreach ($booksData as [$title, $isbn, $price, $date, $stock, $authorIdx, $catIdxs]) {
            $book = new Book();
            $book->setTitle($title);
            $book->setIsbn($isbn);
            $book->setPrice($price);
            $book->setPublishedAt(new \DateTimeImmutable($date));
            $book->setStock($stock);
            $book->setAuthor($authors[$authorIdx]);
            foreach ($catIdxs as $catIdx) {
                $book->addCategory($categories[$catIdx]);
            }
            $manager->persist($book);
        }

        $manager->flush();
    }
}
