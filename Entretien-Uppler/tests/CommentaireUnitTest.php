<?php

namespace App\Tests;

use App\Entity\User;
use App\Entity\Article;
use App\Entity\Commentaire;
use DateTime;

use PHPUnit\Framework\TestCase;

class CommentaireUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $user = new User();
        $article = new Article();
        $datetime = new DateTime();
        $commentaire = new Commentaire();

        $commentaire->setAuteur($user)
                    ->setContenu("contenue")
                    ->setCreatedAt($datetime)
                    ->setDateModification($datetime)
                    ->setArticle($article);


        $this->assertTrue($commentaire->getAuteur() === $user);
        $this->assertTrue($commentaire->getContenu() === 'contenue');
        $this->assertTrue($commentaire->getCreatedAt() === $datetime);
        $this->assertTrue($commentaire->getDateModification() === $datetime);
        $this->assertTrue($commentaire->getArticle() === $article);
    }

    public function testIsFalse()
    {
        $user = new User();
        $article = new Article();
        $datetime = new DateTime();
        $commentaire = new Commentaire();

        $commentaire->setAuteur($user)
                    ->setContenu("contenue")
                    ->setCreatedAt($datetime)
                    ->setArticle($article);


        $this->assertFalse($commentaire->getAuteur() === new User());
        $this->assertFalse($commentaire->getContenu() === 'false');
        $this->assertFalse($commentaire->getCreatedAt() === new DateTime());
        $this->assertFalse($commentaire->getDateModification() === new DateTime());
        $this->assertFalse($commentaire->getArticle() === new Commentaire());
    }

    public function testIsEmpty()
    {
        $commentaire = new Commentaire();

        $this->assertEmpty($commentaire->getAuteur());
        $this->assertEmpty($commentaire->getContenu());
        $this->assertEmpty($commentaire->getCreatedAt());
        $this->assertEmpty($commentaire->getDateModification());
        $this->assertEmpty($commentaire->getArticle());
    }
}
