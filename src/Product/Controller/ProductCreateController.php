<?php

namespace App\Product\Controller;

use App\Product\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Serializer\SerializerInterface;

#[AsController]
class ProductCreateController
{
    public function __construct(
        private EntityManagerInterface $em,
        private SerializerInterface $serializer,
        private Security $security
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $user = $this->security->getUser();

        if (!$user) {
            return new JsonResponse(['error' => 'Unauthorized'], 401);
        }

        $product = new Product();
        $product->setName($data['name']);
        $product->setDescription($data['description'] ?? null);
        $product->setLatitude($data['latitude']);
        $product->setLongitude($data['longitude']);
        $product->setPrice($data['price'] ?? null);
        $product->setOwner($user);

        $this->em->persist($product);
        $this->em->flush();

        return new JsonResponse(
            $this->serializer->normalize($product, 'json', ['groups' => 'product:read']),
            201
        );
    }
}
