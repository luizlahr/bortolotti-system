<?php

declare(strict_types = 1);

namespace Borto\Infrastructure\DB\Repositories;

use Borto\Domain\Equipment\Entities\ModelCollection;
use Borto\Domain\Equipment\Entities\ModelEntity;
use Borto\Domain\Equipment\Exceptions\BrandNotFoundException;
use Borto\Domain\Equipment\Exceptions\CategoryNotFoundException;
use Borto\Domain\Equipment\Exceptions\ModelNotFoundException;
use Borto\Domain\Equipment\Repositories\ModelRepository;
use Borto\Infrastructure\DB\Models\Brand;
use Borto\Infrastructure\DB\Models\Category;
use Borto\Infrastructure\DB\Models\Model;
use Illuminate\Database\Eloquent\Collection;

class EloquentModelRepository implements ModelRepository
{
    private Model $model;
    private Category $category;
    private Brand $brand;

    public function __construct()
    {
        $this->category = new Category();
        $this->brand = new Brand();
        $this->model = new Model();
    }

    public function getAll(): ModelCollection
    {
        $models = $this->model->with(['category', 'brand'])->orderBy('name', 'asc')->get();
        return $this->makeCollection($models);
    }

    public function getById(int $id): ?ModelEntity
    {
        $model = $this->model->find($id);

        return Optional($model)->toEntity() ?? null;
    }

    public function getByName(string $name): ?ModelEntity
    {
        $model = $this->model->where('name', $name)->first();

        return Optional($model)->toEntity() ?? null;
    }

    public function createModel(array $modelData): ModelEntity
    {
        $this->validateCategory($modelData["category_id"]);
        $this->validateBrand($modelData["brand_id"]);

        $model = $this->model->create($modelData);
        return $model->toEntity();
    }

    public function updateModel(int $id, array $modelData): ModelEntity
    {
        $this->validateCategory($modelData["category_id"]);
        $this->validateBrand($modelData["brand_id"]);

        $model = $this->model->find($id);

        if (!$model) {
            throw new ModelNotFoundException();
        }

        $model->update($modelData);
        return $model->toEntity();
    }

    public function deleteModel(int $id): void
    {
        $model = $this->model->find($id);

        if (!$model) {
            throw new ModelNotFoundException();
        }

        $model->delete();
    }

    public function validateCategory(int $id): void
    {
        if (!$this->category->find($id)) {
            throw new CategoryNotFoundException();
        }
    }

    public function validateBrand(int $id): void
    {
        if (!$this->brand->find($id)) {
            throw new BrandNotFoundException();
        }
    }

    /** @param Collection<Model> $models */
    private function makeCollection(Collection $models): ModelCollection
    {
        $modelList = new ModelCollection();
        foreach ($models as $model) {
            $modelList->add($model->toEntity());
        }
        return $modelList;
    }
}
