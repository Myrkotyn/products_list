<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use JMS\Serializer\DeserializationContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    /**
     * @param Request $request
     * @return View
     */
    public function getAllAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Category::class);
        $categories = $repository->childrenHierarchy();
        if (!$categories) {
            return new View("Categories not found", Response::HTTP_NOT_FOUND);
        }
        $view = View::create($categories);
        $context = (new Context())->setGroups(['tree']);
        $view->setContext($context);

        return $view;
    }

    /**
     * @param Request $request
     * @return View
     */
    public function postAction(Request $request)
    {
        /** @var Category $category */
        $category = $this->get('jms_serializer')->deserialize(
            $request->getContent(),
            Category::class,
            'json',
            DeserializationContext::create()->setGroups(['create'])
        );

        $errors = $this->get('validator')->validate($category, null, ['create']);
        if (count($errors) > 0) {
            return View::create($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->flush();
        $view = View::create($category);
        $context = (new Context())->setGroups(['default']);
        $view->setContext($context);

        return $view;
    }

    /**
     * @param Request $request
     * @param int $id
     * @return View
     */
    public function putAction(Request $request, int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository(Category::class)->find($id);
        $response = Response::HTTP_NO_CONTENT;
        $groups = 'update';

        if (!$category) {
            $groups = 'create';
            $response = Response::HTTP_CREATED;
        }

        //@ToDo handler if parent id does not exist
        /** @var Category $deserializedCategory */
        $deserializedCategory = $this->get('jms_serializer')->deserialize(
            $request->getContent(),
            Category::class,
            'json',
            DeserializationContext::create()->setGroups($groups)
        );

        $errors = $this->get('validator')->validate($deserializedCategory, null, $groups);
        if (count($errors) > 0) {
            return View::create($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($category) {
            $category
                ->setTitle($deserializedCategory->getTitle())
                ->setParent($deserializedCategory->getParent());
            $em->merge($category);
        } else {
            $category = new Category();
            $category = $em->merge($deserializedCategory);
        }

        $em->flush();

        return View::create($category, $response);
    }

    public function deleteAction(Request $request, int $id)
    {
        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);

        if (!$category) {
            throw new NotFoundHttpException(sprintf("Category #%d does not exist", $id));
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($category);
        $em->flush();

        return View::create('', Response::HTTP_NO_CONTENT);
    }
}