<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\CommentaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Flex\Path;

class ArticleControleurController extends AbstractController
{
    /**
     * @Route("/article/{id}", name="articler")
     */
    public function article(int $id, ArticleRepository $articleRepository, 
                            CommentaireRepository $commentaireRepository): Response
    {
        return $this->render('article/articleDetaille.html.twig', [
            'article' => $articleRepository->findById($id)[0] ,
            'commentaires' => $commentaireRepository->findByArticleId($id),
        ]);
    }
}
