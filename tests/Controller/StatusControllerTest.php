<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Controller\StatusController;
use PHPUnit\Framework\TestCase;

class StatusControllerTest extends TestCase
{
    public function testStatusReturnsOk(): void
    {
        $response = (new StatusController())->status();

        self::assertSame('{"status":"ok"}', $response->getContent());
    }
}
