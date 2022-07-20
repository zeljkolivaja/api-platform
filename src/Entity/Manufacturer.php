<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
#[ApiResource()]
class Manufacturer
{
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
    private string $name = "";

    /**
     * The description of the manufacturer
     *
     * @ORM\Column(type="text")
     */
    private string $description = "";

    /** the country code of the manufacturer 
     * 
     * @ORM\Column(length=3)
     */
    private string $countryCode;

    /** the date manufacturer was listed 
     * 
     * @ORM\Column(type="datetime")
     */
    private ?\DateTimeInterface $listedDate = null;

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
}
