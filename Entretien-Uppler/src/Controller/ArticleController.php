<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Commentaire;
use App\Form\ArticleType;
use App\Form\CommentaireType;
use App\Repository\ArticleRepository;
use App\Repository\CommentaireRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ArticleController extends AbstractController
{
    /**
     * @Route("/article/{id}", name="article")
     */
    public function article(int $id, ArticleRepository $articleRepository, 
                            CommentaireRepository $commentaireRepository,
                            Request $request): Response
    {
        $article = $articleRepository->findById($id)[0];
        $commentaire = new Commentaire();
        $commentaire->setAuteur($this->getUser())
                    ->setCreatedAt(new DateTime())
                    ->setDateModification(new DateTime())
                    ->setArticle($article);

        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $em->persist($commentaire);
            $em->flush();

            return $this->redirectToRoute('article', ["id" => $article->getId()]);
        }

        return $this->render('article/articleDetaille.html.twig', [
            'article' => $article ,
            'commentaires' => $commentaireRepository->findByArticleId($id),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/ajouter_article/", name="ajouter_article")
     */
    public function ajouterArticle(Request $request): Response
    {
        $article = new Article();

        $article->setAuteur($this->getUser())
                ->setCreatedAt(new DateTime())
                ->setDateModification(new DateTime());
        

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('article', ["id" => $article->getId()]);
        }

        return $this->render('article/new.html.twig', [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/modifier_article/{id}", name="modifier_article")
     */
    public function modifierArticle(int $id, Request $request, ArticleRepository $articleRepository): Response
    {
        $article = $articleRepository->findById($id)[0];

        $article->setAuteur($this->getUser())
                ->setCreatedAt(new DateTime())
                ->setDateModification(new DateTime());
        
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('article', ["id" => $article->getId()]);
        }

        return $this->render('article/modif.html.twig', [
            "form" => $form->createView(),
            "article" => $article
        ]);
    }

    /**
     * @Route("/delete_article/{id}", name="delete_article")
     */
    public function deleteArticle(int $id, ArticleRepository $articleRepository): Response
    {
        $article = $articleRepository->findById($id)[0];

        $manager = $this->getDoctrine()->getManager();

        $manager->remove($article);
        $manager->flush();
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/delete_commentaire/{id}", name="delete_commentaire")
     */
    public function deleteCommentaire(int $id, CommentaireRepository $commentaireRepository): Response
    {
        $commentaire = $commentaireRepository->findById($id)[0];

        $manager = $this->getDoctrine()->getManager();

        $manager->remove($commentaire);
        $manager->flush();
        return $this->redirectToRoute('home');
    }
}
