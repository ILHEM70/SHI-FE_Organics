<?php

namespace App\Entity;

use App\Repository\ProductsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductsRepository::class)]
class Products
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column]
    private ?int $stocks = null;

    /**
     * @var Collection<int, capacity>
     */
    #[ORM\ManyToMany(targetEntity: capacity::class, inversedBy: 'products')]
    private Collection $capacity;

    public function __construct()
    {
        $this->capacity = new ArrayCollection();
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

    public function setDescription(string $description): static
    {
        $this->description = $description;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getStocks(): ?int
    {
        return $this->stocks;
    }

    public function setStocks(int $stocks): static
    {
        $this->stocks = $stocks;

        return $this;
    }

    /**
     * @return Collection<int, capacity>
     */
    public function getCapacity(): Collection
    {
        return $this->capacity;
    }

    public function addCapacity(capacity $capacity): static
    {
        if (!$this->capacity->contains($capacity)) {
            $this->capacity->add($capacity);
        }

        return $this;
    }

    public function removeCapacity(capacity $capacity): static
    {
        $this->capacity->removeElement($capacity);

        return $this;
    }
}
