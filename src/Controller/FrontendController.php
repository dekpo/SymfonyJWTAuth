<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontendController extends AbstractController
{
    private $categoryRepository;
    private $allCategories;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->allCategories = $categoryRepository->findBy(array(), array('name' => 'ASC'));
    }

    #[Route('/', name: 'app_frontend')]
    public function index(): Response
    {
        return $this->render('frontend/index.html.twig', [
            'categories' => $this->allCategories,
        ]);
    }

    #[Route('/category/{slug}', name: 'app_frontend_category')]
    public function category(Category $category): Response
    {
        return $this->render('frontend/category.html.twig', [
            'categories' => $this->allCategories,
            'category' => $category,
            'posts' => $category->getPosts(),
        ]);
    }
}
