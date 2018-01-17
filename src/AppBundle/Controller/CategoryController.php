<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends FOSRestController
{
    /**
     * @param Request $request
     * @param Category $category
     * @return View
     */
    public function getAction(Request $request, Category $category)
    {
        return new View($category, Response::HTTP_OK);
    }

    public function getAllAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(CategoryRepository::class);
        $categories = $repository->findAll();

        if (!$categories) {
            return new View("Categories not found", Response::HTTP_NOT_FOUND);
        }

        return new View($categories, Response::HTTP_OK);
    }
}