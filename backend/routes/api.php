<?php

use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\NomenclatureController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\PropertyController;
use App\Http\Controllers\Api\TradeOfferController;
use App\Models\Nomenclature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource("/categories", CategoryController::class);
Route::apiResource("/brands", BrandController::class);
Route::post(
    "/nomenclatureProperties/{nomenclature}", 
    [NomenclatureController::class, "attachProperties"]
);
Route::delete(
    "/nomenclatureProperties/{nomenclature}", 
    [NomenclatureController::class, "detachProperties"]
);
Route::apiResource("/nomenclatures", NomenclatureController::class);
Route::apiResource("/properties", PropertyController::class);
Route::post(
    "/productImages/{product}", 
    [ProductController::class, "addImages"]
);
Route::delete(
    "/productImages", 
    [ProductController::class, "deleteImages"]
);
Route::post(
    "/productDocuments/{product}", 
    [ProductController::class, "addDocuments"]
);
Route::delete(
    "/productDocuments", 
    [ProductController::class, "deleteDocuments"]
);
Route::apiResource("/products", ProductController::class);
Route::post(
    "/tradeOfferImages/{tradeOffer}", 
    [TradeOfferController::class, "addImages"]
);
Route::delete(
    "/tradeOfferImages", 
    [TradeOfferController::class, "deleteImages"]
);
Route::apiResource("/tradeOffers", TradeOfferController::class);