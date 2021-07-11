<?php

declare(strict_types=1);

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractApiController extends AbstractFOSRestController
{
    protected function buildForm(string $type, mixed $data = null, array $options = []): FormInterface
    {
        /** @var FormFactory $form */
        $form = $this->container->get('form.factory');

        return $form->createNamed('', $type, $data, $options);
    }

    protected function jsonResponse(mixed $data, int $status = Response::HTTP_OK): Response
    {
        return $this->handleView($this->view($data, $status));
    }
}
