<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Services\ProductService;
use App\Http\Requests\API\Products\CreateRequest;
use App\Http\Requests\API\Products\UpdateRequest;

class ProductAPIController extends Controller
{
    public function __construct(public ProductService $productService) {}

    public function create(CreateRequest $request): JsonResponse
    {
        return $this->productService->create($request);
    }

    public function list(Request $request): JsonResponse
    {
        return $this->productService->list($request);
    }

    public function detail(string $id): JsonResponse
    {
        return $this->productService->detail($id);
    }

    public function update(UpdateRequest $request, string $id): JsonResponse
    {
        return $this->productService->update($request, $id);
    }

    public function delete(string $id): JsonResponse
    {
        return $this->productService->delete($id);
    }
}
