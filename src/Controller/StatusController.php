<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/health')]
class StatusController
{
    #[Route('/status', name: 'health_status', methods: 'GET')]
    public function status(): JsonResponse
    {
        return new JsonResponse([
            'status' => 'ok',
        ]);
    }
}
