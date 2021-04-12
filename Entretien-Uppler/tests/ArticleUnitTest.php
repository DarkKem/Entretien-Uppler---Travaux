<?php

namespace App\Tests;

use App\Entity\User;
use App\Entity\Article;
use DateTime;
use PHPUnit\Framework\TestCase;

class ArticleUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $user = new User();
        $datetime = new DateTime();
        $article = new Article();

        $article->setTitre("titre")
                ->setCreatedAt($datetime)
                ->setDateModification($datetime)
                ->setDescription("description")
                ->setAuteur($user);

        $this->assertTrue($article->getTitre() === 'titre');
        $this->assertTrue($article->getCreatedAt() === $datetime);
        $this->assertTrue($article->getDateModification() === $datetime);
        $this->assertTrue($article->getDescription() === 'description');
        $this->assertTrue($article->getAuteur() === $user);
    }

    public function testIsFalse()
    {
        $user = new User();
        $datetime = new DateTime();
        $article = new Article();

        $article->setTitre("titre")
                ->setCreatedAt($datetime)
                ->setDateModification($datetime)
                ->setDescription("description")
                ->setAuteur($user);

        $this->assertFalse($article->getTitre() === 'false');
        $this->assertFalse($article->getCreatedAt() === new DateTime());
        $this->assertFalse($article->getDateModification() === new DateTime());
        $this->assertFalse($article->getDescription() === 'false');
        $this->assertFalse($article->getAuteur() === new User());
    }

    public function testIsEmpty()
    {
        $article = new Article();

        $this->assertEmpty($article->getTitre());
        $this->assertEmpty($article->getCreatedAt());
        $this->assertEmpty($article->getDateModification());
        $this->assertEmpty($article->getDescription());
        $this->assertEmpty($article->getAuteur());
    }
}
