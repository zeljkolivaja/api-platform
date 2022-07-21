<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use DateTimeInterface;


/**
 * A product
 * 
 * @ORM\Entity
 */

#[ApiResource()]
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
    private ?string $partNumber = '';

    /**
     * name of the the product
     * @ORM\Column 
     */
    private string $name = '';

    /**
     * description of the product
     *
     * @ORM\Column(type="text")
     */
    private string $description = '';


    /**
     * The date of issue of the product
     *
     * @var \DateTimeInterface|null
     * @ORM\Column(type="datetime")
     */
    private ?\DateTimeInterface $issueDate = null;


    /**
     * The manufacturer of the product
     * 
     * @ORM\ManyToOne(targetEntity="Manufacturer", inversedBy="product")
     */
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
