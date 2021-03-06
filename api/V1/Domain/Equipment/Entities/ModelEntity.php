<?php

declare(strict_types = 1);

namespace Borto\Domain\Equipment\Entities;

class ModelEntity
{
    private int $id;
    private int $categoryId;
    private int $brandId;
    private string $name;
    private ?CategoryEntity $category;
    private ?BrandEntity $brand;

    public function __construct(
        int $id,
        int $categoryId,
        int $brandId,
        string $name,
        ?CategoryEntity $category = null,
        ?BrandEntity $brand = null
    ) {
        $this->id = $id;
        $this->categoryId = $categoryId;
        $this->brandId = $brandId;
        $this->name = $name;
        $this->category = $category;
        $this->brand = $brand;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function getBrandId(): int
    {
        return $this->brandId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCategory(): ?CategoryEntity
    {
        return $this->category;
    }

    public function getBrand(): ?BrandEntity
    {
        return $this->brand;
    }

    public function toArray(): array
    {
        return [
            "id"          => $this->id,
            "category_id" => $this->categoryId,
            "brand_id"    => $this->brandId,
            "name"        => $this->name,
            "category"    => $this->category->toArray(),
            "brand"       => $this->brand->toArray(),
        ];
    }
}
