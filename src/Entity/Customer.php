<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CustomerRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CustomerRepository::class)
 * @UniqueEntity("email", message="This email is not available")
 * @ApiResource(
 *  normalizationContext={"groups"={"customers:read"}},
 *  denormalizationContext={"groups"={"customers:write"}},
 *  attributes={
 *      "pagination_enabled"=true, 
 *      "pagination_items_per_page"=5,
 *      "order": {"lastName": "asc"},
 *  },
 *  itemOperations={
 *      "GET"={
 *          "path"="/customers/{id}", 
 *          "status"=200, 
 *          "requirements"={"id"="\d+"},
 *          "normalization_context"={"groups"={"customers:single"}}
 *      },
 *      "DELETE"={
 *          "path"="/customers/{id}", 
 *          "status"=204, 
 *          "requirements"={"id"="\d+"},
 *      }
 *  },
 *  collectionOperations={
 *      "GET"={
 *          "path"="/customers", 
 *          "status"=200,
 *          "normalization_context"={"groups"={"customers:list"}}
 *      },
 *      "POST"={
 *          "security"="is_granted('IS_AUTHENTICATED_FULLY')",
 *          "path"="/customers", 
 *          "status"=200
 *      }
 *  },
 * )
 * @ApiFilter(
 *  SearchFilter::class, 
 *  properties={
 *      "firstName": "partial", 
 *      "lastName": "partial",
 *      "price": "exact", 
 *      "email": "partial", 
 *      "company": "partial",
 *  }
 * )
 */
class Customer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"customers:single", "customers:list", "customers:write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"customers:single", "customers:list", "customers:write"})
     * @Assert\NotBlank(message="First name is required")
     * @Assert\Length(
     *      min = 3,
     *      max = 255,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters",
     * )
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"customers:single", "customers:list", "customers:write"})
     * @Assert\NotBlank(message="Name is required")
     * @Assert\Length(
     *      min = 3,
     *      max = 255,
     *      minMessage = "Your name must be at least {{ limit }} characters long",
     *      maxMessage = "Your name cannot be longer than {{ limit }} characters",
     * )
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"customers:single", "customers:list", "customers:write"})
     * @Assert\NotBlank(message="Email is required")
     * @Assert\Email(message = "The email is not a valid email.")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"customers:single", "customers:list", "customers:write"})
     * @Assert\Length(
     *      min = 3,
     *      max = 255,
     *      minMessage = "Your company name must be at least {{ limit }} characters long",
     *      maxMessage = "Your company name cannot be longer than {{ limit }} characters"
     * )
     */
    private $company;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="customers")
     * @Groups({"customers:write", "customers:list", "customers:single"})
     * @Assert\NotBlank(message="User is required")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
