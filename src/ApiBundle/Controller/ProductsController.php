<?php
/**
 * Created by PhpStorm.
 * User: Corballs
 * Date: 3/28/19
 * Time: 12:30 AM
 */

namespace ApiBundle\Controller;
use CoreBundle\Entity\Products;
use CoreBundle\Forms\ProductForm;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ProductsController extends BaseApiController
{
    /**
     * @Rest\Get("/products")
     */
    public function getAllProductsAction()
    {
        $products = $this->getDoctrine()->getRepository('CoreBundle:Products')->findAll();
        return $products;
    }

    /**
     * @Rest\Get("/product/{issn}")
     * @param $issn
     * @return \CoreBundle\Entity\Products|null|object
     */
    public function getProductAction($issn)
    {
        $product = $this->getDoctrine()->getRepository('CoreBundle:Products')->find($issn);

        if (is_null($product))
        {
            throw $this->createNotFoundException(sprintf('No product found with issn "%s"', $issn));
        }

        return $product;
    }

    /**
     * @Rest\Post("/product")
     * @param $request
     * @return View
     */
    public function newProductAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $product = new Products();
        $form = $this->createForm(ProductForm::class, $product, ['csrf_protection' => false, 'allow_extra_fields' => true]);
        $this->processForm($request, $form);

        if (!$form->isValid())
        {
            return $this->createValidationErrorResponse($form);
        }

        $em->persist($product);
        $em->flush();
        return new View($product, Response::HTTP_OK);
    }

    /**
     * @Rest\Put("/product/{issn}")
     * @Rest\Patch("/product/{issn}")
     * @param $issn
     * @param $request
     * @return View
     */
    public function putProductAction($issn, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $this->getDoctrine()->getRepository('CoreBundle:Products')->find($issn);

        if (is_null($product))
        {
            throw $this->createNotFoundException(sprintf('No product found with issn "%s"', $issn));
        }

        $form = $this->createForm(ProductForm::class, $product, ['csrf_protection' => false, 'allow_extra_fields' => true]);
        $this->processForm($request, $form);

        if (!$form->isValid())
        {
            return $this->createValidationErrorResponse($form);
        }

        $em->persist($product);
        $em->flush();
        return new View($product, Response::HTTP_OK);
    }

    /**
     * @Rest\Delete("/product/{issn}")
     * @param $issn
     * @return View
     */
    public function deleteProductAction($issn)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $this->getDoctrine()->getRepository('CoreBundle:Products')->find($issn);

        if (is_null($product))
        {
            throw $this->createNotFoundException(sprintf('No product found with issn "%s"', $issn));
        }

        $em->remove($product);
        $em->flush();
        return new View(null, Response::HTTP_NO_CONTENT);
    }
}