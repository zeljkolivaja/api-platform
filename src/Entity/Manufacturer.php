<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * Manufacturer
 * 
 * @ORM\Entity
 */
#[ApiResource(
    attributes: ["pagination_items_per_page" => 5],
    collectionOperations: ['get', 'post'],
    itemOperations: ['get', 'put', 'patch']
)]
class Manufacturer
{

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }
    /** the ID of the manufactuer 
     * 
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /** the name of the manufacturer 
     * 
     * @ORM\Column
     */
    #[
        Assert\NotBlank,
        Groups(['product.read'])
    ]
    private string $name = "";

    /**
     * The description of the manufacturer
     *
     * @ORM\Column(type="text")
     */
    #[Assert\NotBlank]
    private string $description = "";

    /** the country code of the manufacturer 
     * 
     * @ORM\Column(length=3)
     */
    #[Assert\NotBlank]
    private string $countryCode;

    /** the date manufacturer was listed 
     *
     * @ORM\Column(type="datetime")
     */
    #[Assert\NotNull]
    private ?\DateTimeInterface $listedDate = null;

    /**
     *@var Product[] Available products from this manufacturer, 
     * when manufacturer is deleted his products will be deleted too
     *@ORM\OneToMany(targetEntity="Product", mappedBy="manufacturer", cascade={"persist", "remove"})
     * 
     */
    #[ApiSubresource()]
    private iterable $products;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
    }

    public function getListedDate(): ?\DateTimeInterface
    {
        return $this->listedDate;
    }

    public function setListedDate($listedDate)
    {
        $this->listedDate = $listedDate;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get *@var Product[] Available products from this manufacturer,
     */
    public function getProducts(): iterable
    {
        return $this->products;
    }
}
