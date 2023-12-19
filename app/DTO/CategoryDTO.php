<?php

namespace App\DTO;

class CategoryDTO
{
    private int $id;
    private string $categoryName;
    private string $description;
    private string $isActive;

    /**
     * @param int $id
     * @param string $categoryName
     * @param string $description
     * @param string $isActive
     */
    public function __construct(int $id, string $categoryName, string $description, string $isActive)
    {
        $this->id = $id;
        $this->categoryName = $categoryName;
        $this->description = $description;
        $this->isActive = $isActive;
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getCategoryName(): string
    {
        return $this->categoryName;
    }

    public function setCategoryName(string $categoryName): void
    {
        $this->categoryName = $categoryName;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getIsActive(): string
    {
        return $this->isActive;
    }

    public function setIsActive(string $isActive): void
    {
        $this->isActive = $isActive;
    }

    public function toArray():array{
        return [
            'id' => $this->getId(),
            'name' => $this->getCategoryName(),
            'description' => $this->getDescription(),
            'isActive' =>$this->getIsActive()
        ];
    }



}
