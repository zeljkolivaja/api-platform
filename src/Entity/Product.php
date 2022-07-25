<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use DateTimeInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * A product
 * 
 * @ORM\Entity
 */

#[
    ApiResource(
        normalizationContext: ['groups' => ['product.read']],
        denormalizationContext: ['groups' => ['product.write']]
    ),
    ApiFilter(
        SearchFilter::class,
        properties: [
            'name' => SearchFilter::STRATEGY_PARTIAL,
            'description' => SearchFilter::STRATEGY_PARTIAL,
            'manufacturer.countryCode' => SearchFilter::STRATEGY_EXACT
        ]
    ),
    ApiFilter(
        OrderFilter::class,
        properties: ['issueDate']
    )

]
class Product
{
    /** 
     * id of the product  
     * 
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;


    /**
     * part number of the product
     *
     * @ORM\Column
     */
    #[Assert\NotNull()]
    private ?string $partNumber = null;

    /**
     * name of the the product
     * @ORM\Column 
     */
    #[
        Assert\NotBlank(),
        Groups(['product.read', 'product.write'])
    ]
    private string $name = '';

    /**
     * description of the product
     *
     * @ORM\Column(type="text")
     */
    #[
        Assert\NotBlank(),
        Groups(['product.read', 'product.write'])
    ]
    private string $description = '';


    /**
     * The date of issue of the product
     *
     * @var \DateTimeInterface|null
     * @ORM\Column(type="datetime")
     */
    #[
        Assert\NotNull(),
        Groups(['product.read', 'product.write'])
    ]
    private ?\DateTimeInterface $issueDate = null;


    /**
     * The manufacturer of the product
     * 
     * @ORM\ManyToOne(targetEntity="Manufacturer", inversedBy="products")
     */
    #[
        Assert\NotNull(),
        Groups(['product.read'])
    ]
    private ?Manufacturer $manufacturer = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPartNumber(): ?string
    {
        return $this->partNumber;
    }

    public function setPartNumber($partNumber)
    {
        $this->partNumber = $partNumber;
    }

    public function getName(): string
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

        return $this;
    }

    public function getIssueDate(): DateTimeInterface
    {
        return $this->issueDate;
    }

    public function setIssueDate($issueDate)
    {
        $this->issueDate = $issueDate;

        return $this;
    }

    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;
    }
}
