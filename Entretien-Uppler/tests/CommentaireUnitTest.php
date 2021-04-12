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
                    ->setDate($datetime)
                    ->setArticle($article);


        $this->assertTrue($commentaire->getAuteur() === $user);
        $this->assertTrue($commentaire->getContenu() === 'contenue');
        $this->assertTrue($commentaire->getDate() === $datetime);
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
                    ->setDate($datetime)
                    ->setArticle($article);


        $this->assertFalse($commentaire->getAuteur() === new User());
        $this->assertFalse($commentaire->getContenu() === 'false');
        $this->assertFalse($commentaire->getDate() === new DateTime());
        $this->assertFalse($commentaire->getArticle() === new Commentaire());
    }

    public function testIsEmpty()
    {
        $commentaire = new Commentaire();

        $this->assertEmpty($commentaire->getAuteur());
        $this->assertEmpty($commentaire->getContenu());
        $this->assertEmpty($commentaire->getDate());
        $this->assertEmpty($commentaire->getArticle());
    }
}
