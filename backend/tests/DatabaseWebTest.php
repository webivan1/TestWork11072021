<?php

declare(strict_types=1);

namespace App\Tests;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class DatabaseWebTest extends WebTestCase {

    protected EntityManagerInterface $em;
    protected KernelBrowser $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = $this->createClient(['environment' => 'test']);
        $this->client->disableReboot();
        $this->em = $this->client->getContainer()->get('doctrine.orm.entity_manager');
        $this->em->beginTransaction();
        $this->em->getConnection()->setAutoCommit(false);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        if($this->em->getConnection()->isTransactionActive()) {
            $this->em->rollback();
        }
    }
}
