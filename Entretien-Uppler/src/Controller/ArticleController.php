<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
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
                            CommentaireRepository $commentaireRepository): Response
    {
        return $this->render('article/articleDetaille.html.twig', [
            'article' => $articleRepository->findById($id)[0] ,
            'commentaires' => $commentaireRepository->findByArticleId($id),
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
     * @Route("/modifier_articler/{id}", name="modifier_articler")
     */
    public function modifierArticle(int $id, ArticleRepository $articleRepository, 
                            CommentaireRepository $commentaireRepository): Response
    {
        return $this->render('article/articleDetaille.html.twig', [
            'article' => $articleRepository->findById($id)[0] ,
            'commentaires' => $commentaireRepository->findByArticleId($id),
        ]);
    }
}
