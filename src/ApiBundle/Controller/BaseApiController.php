<?php
/**
 * Created by PhpStorm.
 * User: Corballs
 * Date: 3/27/19
 * Time: 11:56 PM
 */

namespace ApiBundle\Controller;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BaseApiController extends AbstractFOSRestController
{
    protected function processForm(Request $request, FormInterface $form)
    {
        $data = json_decode($request->getContent(), true);
        $removeMissing = $request->getMethod() !== 'PATCH';
        $form->submit($data, $removeMissing);
    }

    protected function getFormErrors(FormInterface $form)
    {
        $errors = [];

        foreach ($form->getErrors() as $error)
        {
            $errors[] = $error->getMessage();
        }

        foreach ($form->all() as $subForm)
        {
            if ($subForm instanceof FormInterface)
            {
                if ($childErrors = $this->getFormErrors($subForm))
                {
                    $errors[$subForm->getName()] = $childErrors;
                }
            }
        }

        return $errors;
    }

    protected function createValidationErrorResponse(FormInterface $form)
    {
        $errors = $this->getFormErrors($form);
        $data = ['type' => 'validation_error', 'title' => 'Validation error occurred', 'errors' => $errors];
        return new JsonResponse($data, Response::HTTP_BAD_REQUEST);
    }
}