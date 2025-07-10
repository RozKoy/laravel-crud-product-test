<?php

namespace App\Http\Repositories;

use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;

class ProductRepository
{
    public function __construct(public Product $product) {}

    public function create(string $name, string $phot, ?string $description): Product
    {
        return $this->product->create([
            'name' => $name,
            'phot' => $phot,

            'description' => $description,
        ]);
    }

    public function getAll(?string $search): Collection
    {
        $data = $this->product->query();

        $data->when(
            $search,
            fn (Builder $query): Builder => $query->whereAny(
                [
                    'name',
                    'description',
                ],
                'LIKE',
                "%$search%",
            ),
        );

        return $data->latest()->get();
    }

    public function getOne(int $id): ?Product
    {
        return $this->product->find($id);
    }

    public function update(Product $product, string $name, string $phot, ?string $description): bool
    {
        return $product->update([
            'name' => $name,
            'phot' => $phot,

            'description' => $description,
        ]);
    }

    public function delete(Product $product): ?bool
    {
        return $product->delete();
    }

    public function savePhoto(UploadedFile $file): bool|string
    {
        return $file->store(Product::PHOTO_PATH);
    }

    public function removePhoto(string $path): void
    {
        if (Storage::exists($path)) {
            Storage::delete($path);
        }
    }
}
