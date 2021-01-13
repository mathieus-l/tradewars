<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $average_price;

    /**
     * @ORM\Column(type="integer")
     */
    private $variation;

    /**
     * @ORM\Column(type="integer")
     */
    private $current_price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAveragePrice(): ?int
    {
        return $this->average_price;
    }

    public function setAveragePrice(int $average_price): self
    {
        $this->average_price = $average_price;

        return $this;
    }

    public function getVariation(): ?int
    {
        return $this->variation;
    }

    public function setVariation(int $variation): self
    {
        $this->variation = $variation;

        return $this;
    }

    public function getCurrentPrice(): ?int
    {
        return $this->current_price;
    }

    public function setCurrentPrice(int $current_price): self
    {
        $this->current_price = $current_price;

        return $this;
    }
}
