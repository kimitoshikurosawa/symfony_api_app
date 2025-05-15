<?php

namespace App\Product\Controller;

use App\Product\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Serializer\SerializerInterface;

#[AsController]
class ProductNearbyController
{
    public function __construct(
        private ProductRepository $repository,
        private SerializerInterface $serializer
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        $lat = (float) $request->query->get('lat');
        $lng = (float) $request->query->get('lng');
        $radius = (float) $request->query->get('radius', 10);

        $products = $this->repository->findNearby($lat, $lng, $radius);

        return new JsonResponse(
            $this->serializer->serialize($products, 'json', ['groups' => ['product:read']]),
            200,
            [],
            true
        );
    }
}
