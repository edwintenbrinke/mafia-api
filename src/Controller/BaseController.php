<?php

namespace App\Controller;

use InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Exception\RuntimeException;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class BaseController
 * @author Edwin ten Brinke <edwin.ten.brinke@extendas.com>
 */
abstract class BaseController extends AbstractController
{
    /**
     * @param Request $request
     * @param string  $form_class
     *
     * @return mixed
     *
     * @throws RuntimeException
     */
    public function formValidatePostData(Request $request, string $form_class)
    {
        $data = json_decode($request->getContent(), true);
        if (!$data)
        {
            throw new InvalidArgumentException('Invalid JSON sent.');
        }

        // DTO & Form Validation.
        $form = $this->createForm($form_class);
        $form->submit($data, false);
        if (!$form->isSubmitted() || !$form->isValid())
        {
            throw new InvalidArgumentException(json_encode($this->getFormErrors($form)));
        }

        return $form->getData();
    }

    /**
     * @param FormInterface $form
     *
     * @return array
     */
    public function getFormErrors(FormInterface $form)
    {
        $errors = [];
        foreach ($form->getErrors() as $error)
        {
            $errors[] = $error->getMessage();
        }
        foreach ($form->all() as $child_form)
        {
            if ($child_form instanceof FormInterface && $child_errors = $this->getFormErrors($child_form))
            {
                $errors[$child_form->getName()] = $child_errors;
            }
        }

        return $errors;
    }

    public function returnFormErrors(FormInterface $form)
    {
        return new JsonResponse($this->getFormErrors($form));
    }

    /**
     * The value of the groups key can be a single string, or an array of strings.
     *
     * @param SerializerInterface $serializer
     * @param $data
     * @param $groups
     *
     * @return Response
     */
    public function jsonResponse(SerializerInterface $serializer, $data, $groups = null)
    {
        $context = [];
        if ($groups && count($groups) > 0)
        {
            $context['groups'] = $groups;
        }

        return new JsonResponse(
            $serializer->serialize(
                $data,
                'json',
                $context
            ),
            Response::HTTP_OK,
            [],
            true
        );
    }
}
