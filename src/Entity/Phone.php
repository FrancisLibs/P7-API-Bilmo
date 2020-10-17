<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PhoneRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ORM\Entity(repositoryClass=PhoneRepository::class)
 * @ApiResource(
 *  attributes={
 *      "pagination_enabled"=true, 
 *      "pagination_items_per_page"=5,
 *      "order": {"price": "asc"},
 *  },
 *  itemOperations={
 *      "GET"={
 *          "path"="/phones/{id}", 
 *          "status"=200, 
 *          "requirements"={"id"="\d+"},
 *          "normalization_context"={"groups"={"single"}},
 *          "schemes"={"https"},
 *      }
 *  },
 *  collectionOperations={
 *      "GET"={
 *          "path"="/phones", 
 *          "status"=200,
 *          "normalization_context"={"groups"={"list"}},
 *          "schemes"={"https"},
 *      }
 *  },
 * )
 * @ApiFilter(
 *  SearchFilter::class, 
 *  properties={
 *      "brand": "partial", 
 *      "price", 
 *      "color": "partial",
 *  }
 * )
 */
class Phone
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"list", "single"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Brand is required")
     * @Groups({"list", "single"})
     */
    private $brand;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Price is required")
     * @Assert\Type(type="numeric", message ="Price must be numeric")
     * @Groups({"list", "single"})
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"list", "single"})
     */
    private $color;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"single"})
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice($price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
