<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddDocumentsToProductRequest;
use App\Http\Requests\AddImagesToProductRequest;
use App\Http\Requests\RemoveProductDocumentsRequest;
use App\Http\Requests\RemoveProductImagesRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Http\Resources\TradeOfferCollection;
use App\Models\Product;
use App\Models\ProductDocument;
use App\Models\ProductImage;
use App\Services\ProductService;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json([
            "data" => new ProductCollection(Product::all())
        ], 200);
    }

    public function store(StoreProductRequest $request)
    {
        $product = ProductService::createProductByRequestData($request->validated());
        return response()->json([
            "data" => new ProductResource($product)
        ], 200);
    }

    public function addImages(AddImagesToProductRequest $request, Product $product)
    {
        $validated = $request->validated();
        $images = [];

        // Сохранение каждой картинки
        foreach ($validated['images'] as $image) {
            // Сохранение файла в папку 'products' в storage
            $path = $image['file']->store('product_images', 'public');  // Сохраняем картинку в 'storage/app/public/products'

            // Получаем URI к файлу, например: /storage/products/image.jpg
            $uri = Storage::url($path);

            // Добавляем URI в массив
            $images[] = ProductImage::create([
                "file_name" => $uri,
                "caption" => $image['caption'],
                "product_id" => $product->id
            ]);
        }

        // Возвращаем массив с URI
        return response()->json([
            "message" => "Images was added to product succesfully",
            'images' => $images
        ], 200);
    }

    public function deleteImages(RemoveProductImagesRequest $request)
    {
        $validated = $request->validated();
        foreach($validated['images'] as $image_id){
            $image = ProductImage::find($image_id);
            Storage::delete($image->file_name);
            $image->delete();
        }
        return response()->json([
            "message" => "Images was deleted succesfully"
        ], 200);
    }
    public function addDocuments(AddDocumentsToProductRequest $request, Product $product)
    {
        $validated = $request->validated();
        $documents = [];

        // Сохранение каждой картинки
        foreach ($validated['documents'] as $image) {
            // Сохранение файла в папку 'products' в storage
            $path = $image['file']->store('product_documents', 'public');  // Сохраняем картинку в 'storage/app/public/products'

            // Получаем URI к файлу, например: /storage/products/image.jpg
            $uri = Storage::url($path);

            // Добавляем URI в массив
            $documents[] = ProductDocument::create([
                "file_name" => $uri,
                "caption" => $image['caption'],
                "product_id" => $product->id
            ]);
        }

        // Возвращаем массив с URI
        return response()->json([
            "message" => "Documents was added to product succesfully",
            'documents' => $documents
        ], 200);
    }

    public function deleteDocuments(RemoveProductDocumentsRequest $request)
    {
        $validated = $request->validated();
        foreach($validated['documents'] as $document_id){
            $document = ProductDocument::find($document_id);
            Storage::delete($document->file_name);
            $document->delete();
        }
        return response()->json([
            "message" => "Documents was deleted succesfully"
        ], 200);
    }

    public function show(Product $product)
    {
        return response()->json([
            "data" => new ProductResource($product),
            "trade_offers" => new TradeOfferCollection($product->tradeOffers)
        ], 200);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        ProductService::updateProductByRequestData($product, $request->validated());
        return response()->json([
            "data" => new ProductResource($product)
        ], 200);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            "message" => "Product was deleted"
        ], 200);
    }
}
