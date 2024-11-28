<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddImagesToTradeOfferRequest;
use App\Http\Requests\RemoveTradeOfferImagesRequest;
use App\Http\Requests\StoreTradeOfferRequest;
use App\Http\Requests\UpdateTradeOfferRequest;
use App\Http\Resources\TradeOfferCollection;
use App\Http\Resources\TradeOfferResource;
use App\Models\TradeOffer;
use App\Models\TradeOfferImage;
use App\Services\TradeOfferService;
use Illuminate\Support\Facades\Storage;

class TradeOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            "data" => new TradeOfferCollection(TradeOffer::all())
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTradeOfferRequest $request)
    {
        // Используем сервис для создания нового TradeOffer
        $tradeOffer = TradeOfferService::createTradeOfferByRequestData($request->validated());
        return response()->json([
            "data" => new TradeOfferResource($tradeOffer)
        ], 200);
    }
    public function addImages(AddImagesToTradeOfferRequest $request, TradeOffer $tradeOffer)
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
            $images[] = TradeOfferImage::create([
                "file_name" => $uri,
                "caption" => $image['caption'],
                "trade_offer_id" => $tradeOffer->id
            ]);
        }

        // Возвращаем массив с URI
        return response()->json([
            "message" => "Images was added to trade offer succesfully",
            'images' => $images
        ], 200);
    }

    public function deleteImages(RemoveTradeOfferImagesRequest $request)
    {
        $validated = $request->validated();
        foreach($validated['images'] as $image_id){
            $image = TradeOfferImage::find($image_id);
            Storage::delete($image->file_name);
            $image->delete();
        }
        return response()->json([
            "message" => "Images was deleted succesfully"
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(TradeOffer $tradeOffer)
    {
        return response()->json([
            "data" => new TradeOfferResource($tradeOffer)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTradeOfferRequest $request, TradeOffer $tradeOffer)
    {
        // Используем сервис для обновления данных TradeOffer
        TradeOfferService::updateTradeOfferByRequestData($tradeOffer, $request->validated());
        return response()->json([
            "data" => new TradeOfferResource($tradeOffer)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TradeOffer $tradeOffer)
    {
        // Удаляем TradeOffer
        $tradeOffer->delete();
        return response()->json([
            "message" => "TradeOffer was deleted"
        ], 200);
    }
}
