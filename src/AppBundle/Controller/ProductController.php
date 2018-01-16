<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Form\ProductType;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ProductController
 *
 * @Rest\Route("/api/product")
 */
class ProductController extends FOSRestController
{
    /**
     * Get product by id
     *
     * @Rest\Get("/{id}", name="get_product")
     *
     * @param Request $request
     * @param Product $product
     * @return View
     */
    public function getAction(Request $request, Product $product)
    {
        return new View($product, Response::HTTP_OK);
    }

    /**
     * Get all products
     *
     * @Rest\Get("", name="get_all_books")
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
            return new View("Products not found", Response::HTTP_NOT_FOUND);
        }
        return new View($products, Response::HTTP_OK);
    }

    /**
     * Create new product
     *
     * @Rest\Post("", name="create_new_product")
     *
     * @param Request $request
     * @return View
     */
    public function createAction(Request $request)
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product, [
            'method' => Request::METHOD_POST
        ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $product = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return new View($product, Response::HTTP_CREATED);
        }

        return new View($form, Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Update product entity
     *
     * @Rest\Put("/{id}", name="update_product")
     *
     * @param Request $request
     * @param $id
     * @return View
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->find($id);
        $response = Response::HTTP_NO_CONTENT;
        if (null === $product) {
            $product = new Product();
            $response = Response::HTTP_CREATED;
        }

        $form = $this->createForm(ProductType::class, $product, [
            'method' => Request::METHOD_PUT
        ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $product = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return new View($product, $response);
        }

        return new View($form, Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Delete product entity
     *
     * @Rest\Delete("/{id}", name="delete_product")
     *
     * @param Request $request
     * @param Product $product
     * @return View
     */
    public function deleteAction(Request $request, Product $product)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();

        return View::create('', Response::HTTP_NO_CONTENT);
    }
}