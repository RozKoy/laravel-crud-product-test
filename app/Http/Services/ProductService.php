<?php

namespace App\Http\Services;

use App\Traits\APIResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Repositories\ProductRepository;
use App\Http\Requests\API\Products\CreateRequest;
use App\Http\Requests\API\Products\UpdateRequest;

class ProductService
{
    use APIResponse;

    public function __construct(public ProductRepository $productRepository) {}

    public function create(CreateRequest $request): JsonResponse
    {
        [
            'name' => $nameReq,
            'description' => $descriptionReq,
        ] = $request;

        $photo = null;

        DB::beginTransaction();

        try {
            if ($request->hasFile('phot')) {
                $photo = $this->productRepository->savePhoto($request->file('phot'));
            }

            $product = $this->productRepository->create($nameReq, $photo ?? '', $descriptionReq);

            DB::commit();

            return $this->Created('Product created', $product);
        } catch (\Throwable $th) {
            if ($photo) {
                $this->productRepository->removePhoto($photo);
            }

            DB::rollBack();

            throw $th;
        }
    }

    public function list(Request $request): JsonResponse
    {
        $searchQuery = $request->query('search');

        return $this->Success('Product list', $this->productRepository->getAll($searchQuery));
    }

    public function detail(string $id): JsonResponse
    {
        if (is_numeric($id)) {
            if ($product = $this->productRepository->getOne((int) $id)) {
                return $this->Success('Product detail', $product);
            }
        }

        return $this->NotFound('Product not found');
    }

    public function update(UpdateRequest $request, string $id): JsonResponse
    {
        if (is_numeric($id)) {
            if ($product = $this->productRepository->getOne((int) $id)) {
                [
                    'name' => $nameReq,
                    'description' => $descriptionReq,
                ] = $request;

                $photo = null;

                DB::beginTransaction();

                try {
                    $oldPhoto = null;
                    if ($request->hasFile('phot')) {
                        $photo = $this->productRepository->savePhoto($request->file('phot'));
                        $oldPhoto = $product->phot;
                    }

                    $this->productRepository->update($product, $nameReq, $photo ?? $product->phot, $descriptionReq);

                    if ($oldPhoto) {
                        $this->productRepository->removePhoto($oldPhoto);
                    }

                    DB::commit();

                    return $this->Success('Product updated', $product);
                } catch (\Throwable $th) {
                    if ($photo) {
                        $this->productRepository->removePhoto($photo);
                    }

                    DB::rollBack();

                    throw $th;
                }
            }
        }

        return $this->NotFound('Product not found');
    }

    public function delete(string $id): JsonResponse
    {
        if (is_numeric($id)) {
            if ($product = $this->productRepository->getOne((int) $id)) {
                if ($product->phot) {
                    $this->productRepository->removePhoto($product->phot);
                }

                $this->productRepository->delete($product);

                return $this->Success('Product deleted');
            }
        }

        return $this->NotFound('Product not found');
    }
}
