<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * For all methods in class
 * @IsGranted("ROLE_ADMIN_COMMENT")
 */
class CommentAdminController extends AbstractController
{
    const SEARCH_PARAM = 'q';
    /**
     * @Route("/admin/comment", name="comment_admin")
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(CommentRepository $commentRepository, Request $request, PaginatorInterface $pagination)
    {
//        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $queryBuilder = $commentRepository->getWithSearchQueryBuilder($request->get(self::SEARCH_PARAM));
        $pagination = $pagination->paginate(
            $queryBuilder, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        return $this->render('comment_admin/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }
}
