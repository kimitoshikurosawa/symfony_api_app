<?php

namespace App\Product\Controller;

use App\Product\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Serializer\SerializerInterface;

#[AsController]
class ProductSearchController
{
    public function __construct(
        private ProductRepository $repository,
        private SerializerInterface $serializer
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        $q = $request->query->get('q');
        $products = $this->repository->createQueryBuilder('p')
            ->where('p.name LIKE :q OR p.description LIKE :q')
            ->setParameter('q', "%$q%")
            ->getQuery()
            ->getResult();

        return new JsonResponse(
            $this->serializer->normalize($products, 'json', ['groups' => 'product:read'])
        );
    }
}
