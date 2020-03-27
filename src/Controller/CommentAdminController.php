<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommentAdminController extends AbstractController
{
    const SEARCH_PARAM = 'q';
    /**
     * @Route("/admin/comment", name="comment_admin")
     */
    public function index(CommentRepository $commentRepository, Request $request)
    {
        return $this->render('comment_admin/index.html.twig', [
            'comments' => $commentRepository->findAllWithSearch($request->get(self::SEARCH_PARAM)),
        ]);
    }
}
