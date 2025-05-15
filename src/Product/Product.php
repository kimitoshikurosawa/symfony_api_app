<?php

namespace App\Product;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\OpenApi\Model\MediaType;
use ApiPlatform\OpenApi\Model\Operation;
use ApiPlatform\OpenApi\Model\RequestBody;
use App\Product\Controller\ProductCreateController;
use App\Product\Controller\ProductNearbyController;
use App\Product\Controller\ProductSearchController;
use App\User\User;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ApiResource(
    operations: [
        // ✅ Nearby en premier
        new GetCollection(
            uriTemplate: '/products/nearby/search',
            controller: ProductNearbyController::class,
            openapi: new Operation(
                summary: 'Recherche géolocalisée',
                parameters: [
                    ['name' => 'lat', 'in' => 'query', 'required' => true, 'schema' => ['type' => 'number']],
                    ['name' => 'lng', 'in' => 'query', 'required' => true, 'schema' => ['type' => 'number']],
                    ['name' => 'radius', 'in' => 'query', 'required' => false, 'schema' => ['type' => 'number', 'default' => 10]]
                ]
            ),
            paginationEnabled: false,
            normalizationContext: ['groups' => ['product:read']],
            read: false,
            priority: 20,
            name: 'product_nearby'
        ),
        // ✅ Search ensuite
        new GetCollection(
            uriTemplate: '/products/search/all',
            controller: ProductSearchController::class,
            openapi: new Operation(
                summary: 'Recherche de produits',
                parameters: [
                    ['name' => 'q', 'in' => 'query', 'required' => true, 'schema' => ['type' => 'string']]
                ]
            ),
            paginationEnabled: false,
            normalizationContext: ['groups' => ['product:read']],
            read: false,
            priority: 19,
            name: 'product_search'
        ),
        // ✅ Create ensuite
        new Post(
            uriTemplate: '/products/create',
            controller: ProductCreateController::class,
            openapi: new Operation(
                summary: 'Création d\'un produit',
                description: 'Crée un nouveau produit.',
                security: [['bearerAuth' => []]]
            ),
            normalizationContext: ['groups' => ['product:read']],
            security: "is_granted('ROLE_USER')",
            securityMessage: 'Only authenticated users can create a new product.',
            read: false,
            deserialize: false,
            priority: 18,
            name: 'product_create'
        ),

        // ✅ Routes par défaut en dernier
        new GetCollection(
            security: "is_granted('PUBLIC_ACCESS')",
            securityMessage: 'Only authenticated users can view the list of products.'
        ),
        new Get(
            security: "is_granted('PUBLIC_ACCESS')",
            securityMessage: 'Only authenticated users can view a product.'
        ),
        new Delete(
            security: "is_granted('ROLE_USER') and object.getOwner() == user",
            securityMessage: 'Only the owner of the product can delete it.'
        )
    ],
    normalizationContext: ['groups' => ['product:read']],
    denormalizationContext: ['groups' => ['product:write']]
)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['product:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['product:read', 'product:write'])]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['product:read', 'product:write'])]
    private ?string $description = null;

    #[ORM\Column]
    #[Groups(['product:read', 'product:write'])]
    private ?float $latitude = null;

    #[ORM\Column]
    #[Groups(['product:read', 'product:write'])]
    private ?float $longitude = null;

    #[ORM\Column]
    #[Groups(['product:read', 'product:write'])]
    private ?float $price = null;

    #[ORM\Column]
    #[Groups(['product:read'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[Groups(['product:read'])]
    private ?User $owner = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): static
    {
        $this->owner = $owner;

        return $this;
    }
}
