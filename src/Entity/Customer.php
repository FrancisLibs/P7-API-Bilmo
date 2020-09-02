<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CustomerRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CustomerRepository::class)
 * @ApiResource(
 *  collectionOperations={"GET", "POST"},
 *  itemOperations={"GET", "DELETE"},
 *  attributes={
 *      "pagination_enabled"=true,
 *      "pagination_items_per_page"=20
 *  },
 *  normalizationContext={
 *      "groups"={"customers_read"}
 *  },
 *  denormalizationContext={
 *      "groups"={"customers_write"}
 *  }
 * )
 */
class Customer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"customers_read", "customers_write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"customers_read", "customers_write"})
     * @Assert\Length(
     *      min = 3,
     *      max = 255,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters",
     *      allowEmptyString = false
     * )
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"customers_read", "customers_write"})
     * @Assert\Length(
     *      min = 3,
     *      max = 255,
     *      minMessage = "Your name must be at least {{ limit }} characters long",
     *      maxMessage = "Your name cannot be longer than {{ limit }} characters",
     *      allowEmptyString = false
     * )
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"customers_read", "customers_write"})
     * @Assert\NotBlank(message="Email is required")
     * @Assert\Email(message = "The email is not a valid email.")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"customers_read", "customers_write"})
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
     * @Groups({"customers_read", "customers_write"})
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
