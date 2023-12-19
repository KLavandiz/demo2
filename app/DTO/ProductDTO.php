<?php

namespace App\DTO;

class ProductDTO
{
    public int $id;
    public string $name;
    public string $description;
    public string $image;
    public string $price;
    public array $currency;
    public string $isActive;
    public array $categoryId;

    /**
     * @param int $id
     * @param string $name
     * @param string $description
     * @param string $image
     * @param string $price
     * @param array $currency
     * @param string $isActive
     * @param array $categoryId
     */
    public function __construct(int $id, string $name, string $description, string $image, string $price, array $currency, string $isActive, array $categoryId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->price = $price;
        $this->currency = $currency;
        $this->isActive = $isActive;
        $this->categoryId = $categoryId;
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function setPrice(string $price): void
    {
        $this->price = $price;
    }

    public function getCurrency(): array
    {
        return $this->currency;
    }

    public function setCurrency(array $currency): void
    {
        $this->currency = $currency;
    }

    public function getIsActive(): string
    {
        return $this->isActive;
    }

    public function setIsActive(string $isActive): void
    {
        $this->isActive = $isActive;
    }

    public function getCategoryId(): array
    {
        return $this->categoryId;
    }

    public function setCategoryId(array $categoryId): void
    {
        $this->categoryId = $categoryId;
    }


}
