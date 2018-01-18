<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use JMS\Serializer\DeserializationContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Context\Context;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class ProductController
 * @package AppBundle\Controller
 */
class ProductController extends FOSRestController
{
    /**
     * Get product by id
     *
     * @param Request $request
     * @param int $id
     * @throws NotFoundHttpException
     * @return View
     */
    public function getAction(Request $request, int $id)
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);

        if (!$product instanceof Product) {
            throw new NotFoundHttpException(sprintf("Product #%d does not exist", $id));
        }
        $view = View::create($product);
        $context = (new Context())->setGroups(['default']);
        $view->setContext($context);

        return $view;
    }

    /**
     * Get all products
     *
     * @param Request $request
     * @return View
     */
    public function getAllAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Product::class);
        $search = $request->query->get('search', null);

        if ($search) {
            $products = $repository->search($search);
        } else {
            $products = $repository->findAll();
        }

        if (!$products) {
            throw new NotFoundHttpException("Product not found!");
        }
        $view = View::create($products);
        $context = (new Context())->setGroups(['default']);
        $view->setContext($context);

        return $view;
    }

    /**
     * Create new product
     *
     * @param Request $request
     * @return View
     */
    public function postAction(Request $request)
    {
        /** @var Product $product */
        $product = $this->get('jms_serializer')->deserialize(
            $request->getContent(),
            Product::class,
            'json',
            DeserializationContext::create()->setGroups(['create'])
        );

        $parent = $product->getCategory();
        if ($parent !== null) {
            $parentId = $parent->getId();
            $categoryRepository = $this->getDoctrine()->getRepository(Category::class);
            $category = $categoryRepository->find($parentId);
            if ($category) {
                $product->setCategory($category);
            } else {
                $product->setCategory(null);
            }
        }

        $errors = $this->get('validator')->validate($product, null, ['create']);
        if (count($errors) > 0) {
            return View::create($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();

        $view = View::create($product);
        $context = (new Context())->setGroups(['default']);
        $view->setContext($context);

        return $view;
    }

    /**
     * Update product entity
     *
     * @param Request $request
     * @param integer $id
     * @return View
     */
    public function putAction(Request $request, int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->find($id);
        $response = Response::HTTP_NO_CONTENT;
        $groups = ['update'];

        if (!$product) {
            $groups = ['create'];
            $response = Response::HTTP_CREATED;
        }

        /** @var Product $deserializedProduct */
        $deserializedProduct = $this->get('jms_serializer')->deserialize(
            $request->getContent(),
            Product::class,
            'json',
            DeserializationContext::create()->setGroups($groups)
        );

        $category = $deserializedProduct->getCategory();
        if ($category !== null) {
            $parentId = $category->getId();
            $categoryRepository = $this->getDoctrine()->getRepository(Category::class);
            $category = $categoryRepository->find($parentId);
            if ($category) {
                $deserializedProduct->setCategory($category);
                $product->setCategory($category);
            } else {
                $deserializedProduct->setCategory(null);
                $product->setCategory(null);
            }
        }

        $errors = $this->get('validator')->validate($deserializedProduct, null, $groups);
        if (count($errors) > 0) {
            return View::create($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        if ($product) {
            $product->setName($deserializedProduct->getName())
                ->setPrice($deserializedProduct->getPrice());
            $deserializedProduct = $product;
        }

        $em->persist($deserializedProduct);
        $em->flush();

        return View::create($deserializedProduct, $response);
    }

    /**
     * Delete product entity
     *
     * @param Request $request
     * @param int $id
     * @return View
     */
    public function deleteAction(Request $request, int $id)
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);

        if (!$product) {
            throw new NotFoundHttpException(sprintf("Product #%d does not exist", $id));
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();

        return View::create('', Response::HTTP_NO_CONTENT);
    }
}