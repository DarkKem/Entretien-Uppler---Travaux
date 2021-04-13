<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Commentaire;
use App\Entity\User as EntityUser;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    public function load(ObjectManager $manager)
    {
        // Utilisation de Faker
        $faker = Factory::create('fr_FR');

        //Creation d'un user
        $user = new EntityUser();

        $user->setEmail('user@test.com')
             ->setNom($faker->firstName())
             ->setPrenom($faker->lastName());
            

        $password = $this->encoder->encodePassword($user, 'password');
        $user->setPassword($password);

        $manager->persist($user);

        //Création de 10 article
        for($i=0; $i < 10; $i++ )
        {
            $article = new Article();

            $article->setTitre($faker->word(3, true))
                    ->setCreatedAt($faker->dateTime())
                    ->setDateModification(new DateTime('now'))
                    ->setAuteur($user)
                    ->setDescription($faker->text(350));

            

            //Création de 10 Commentaire par article
            for($j=0; $j < 10; $j++ )
            {
                $commentaire = new Commentaire();

                $commentaire->setAuteur($user)
                            ->setCreatedAt($faker->dateTime())
                            ->setDateModification(new DateTime('now'))
                            ->setArticle($article)
                            ->setContenu($faker->text(350));
                
                $manager->persist($commentaire);

                $article->addCommentaire($commentaire);
            }

            $manager->persist($article);
        }


        

        $manager->flush();
    }
}
