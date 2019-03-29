<?php
/**
 * Created by PhpStorm.
 * User: Corballs
 * Date: 3/28/19
 * Time: 12:06 AM
 */

namespace ApiBundle\Controller;
use CoreBundle\Entity\Customers;
use CoreBundle\Forms\CustomerForm;
use FOS\RestBundle\View\View;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CustomersController extends BaseApiController
{
    /**
     * @Rest\Get("/customers")
     */
    public function getAllCustomersAction()
    {
        $result = $this->getDoctrine()->getRepository('CoreBundle:Customers')->findAll();
        return $result;
    }

    /**
     * @Rest\Get("/customer/{uuid}")
     * @param $uuid
     * @return \CoreBundle\Entity\Customers|null|object
     */
    public function getCustomerAction($uuid)
    {
        $customer = $this->getDoctrine()->getRepository('CoreBundle:Customers')->find($uuid);

        if (is_null($customer))
        {
            throw $this->createNotFoundException(sprintf('No customer found with uuid "%s"', $uuid));
        }

        return $customer;
    }

    /**
     * @Rest\Post("/customer")
     * @param $request
     * @param $encoder
     * @return View
     */
    public function newCustomerAction(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $em = $this->getDoctrine()->getManager();
        $customer = new Customers();
        $form = $this->createForm(CustomerForm::class, $customer, ['csrf_protection' => false, 'allow_extra_fields' => true]);
        $this->processForm($request, $form);

        if (!$form->isValid())
        {
            return $this->createValidationErrorResponse($form);
        }

        $password = $encoder->encodePassword($customer, $form->getData()->getPassword());
        $customer->setPassword($password);
        $customer->setEnabled(true);
        $em->persist($customer);
        $em->flush();
        return new View($customer, Response::HTTP_OK);
    }

    /**
     * @Rest\Put("/customer/{uuid}")
     * @Rest\Patch("/customer/{uuid}")
     * @param $uuid
     * @param $request
     * @param $encoder
     * @return View
     */
    public function putCustomerAction($uuid, Request $request, UserPasswordEncoderInterface $encoder)
    {
        $em = $this->getDoctrine()->getManager();
        $customer = $this->getDoctrine()->getRepository('CoreBundle:Customers')->find($uuid);

        if (is_null($customer))
        {
            throw $this->createNotFoundException(sprintf('No customer found with uuid "%s"', $uuid));
        }

        $form = $this->createForm(CustomerForm::class, $customer, ['csrf_protection' => false, 'allow_extra_fields' => true]);
        $this->processForm($request, $form);

        if (!$form->isValid())
        {
            return $this->createValidationErrorResponse($form);
        }

        if ($request->get('password'))
        {
            $password = $encoder->encodePassword($customer, $form->getData()->getPassword());
            $customer->setPassword($password);
        }

        $em->persist($customer);
        $em->flush();
        return new View($customer, Response::HTTP_OK);
    }

    /**
     * @Rest\Delete("/customer/{uuid}")
     * @param $uuid
     * @return View
     */
    public function deleteCustomerAction($uuid)
    {
        $em = $this->getDoctrine()->getManager();
        $customer = $this->getDoctrine()->getRepository('CoreBundle:Customers')->find($uuid);

        if (!$customer)
        {
            throw $this->createNotFoundException(sprintf('No customer found with uuid "%s"', $uuid));
        }

        $em->remove($customer);
        $em->flush();
        return new View(null, Response::HTTP_NO_CONTENT);
    }
}