<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Quote\Entities\Quote;
use App\Model\Quote\UseCases;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/quote', name: 'quote_')]
class QuoteController extends AbstractApiController
{
    #[Route(name: 'index', methods: ['GET'])]
    public function index(Request $request, UseCases\Request\Handler $handler): Response
    {
        $form = $this->buildForm(UseCases\Request\Form::class);
        $form->handleRequest($request);

        /** @var UseCases\Request\Command $command */
        $command = $form->isSubmitted() && $form->isValid()
            ? $form->getData()
            : new UseCases\Request\Command();

        return $this->jsonResponse($handler->getList($command, 15));
    }

    #[Route('/{quote}', name: 'detail', methods: ['GET'], requirements: ['quote' => '\d+'])]
    public function detail(Quote $quote): Response
    {
        return $this->jsonResponse($quote);
    }

    #[Route(name: 'create', methods: ['POST'])]
    public function create(Request $request, UseCases\Create\Handler $handler): Response
    {
        $form = $this->buildForm(UseCases\Create\Form::class);
        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->jsonResponse($form, Response::HTTP_BAD_REQUEST);
        }

        /** @var UseCases\Create\Command $command */
        $command = $form->getData();

        $quote = $handler->create($command);

        return $this->jsonResponse([
            'status' => 'ok',
            'quote' => $quote
        ]);
    }

    #[Route('/{quote}', name: 'update', methods: ['POST'], requirements: ['quote' => '\d+'])]
    public function update(Request $request, Quote $quote, UseCases\Update\Handler $handler): Response
    {
        $form = $this->buildForm(UseCases\Update\Form::class);
        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->jsonResponse($form, Response::HTTP_BAD_REQUEST);
        }

        /** @var UseCases\Update\Command $command */
        $command = $form->getData();

        $handler->update($quote, $command);

        return $this->jsonResponse([
            'status' => 'ok',
            'quote' => $quote
        ]);
    }

    #[Route('/{quote}', name: 'delete', methods: ['DELETE'], requirements: ['quote' => '\d+'])]
    public function delete(Quote $quote, UseCases\Delete\Handler $handler): Response
    {
        $handler->delete($quote);

        return $this->jsonResponse(['status' => 'ok']);
    }
}
