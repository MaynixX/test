<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;



/**
 * @OA\Post(
 *     path="/api/brands",
 *     summary="Создание бренда",
 *     tags={"Brand"},
 * 
 *     @OA\RequestBody(
 *         required=true,
 *         content={
 *             @OA\MediaType(
 *                 mediaType="multipart/form-data",
 *                 @OA\Schema(
 *                     type="object",
 *                     required={"title"},
 *                     @OA\Property(
 *                         property="title",
 *                         type="string",
 *                         description="Название (макс. 255 символов)",
 *                         maxLength=255
 *                     ),
 *                     @OA\Property(
 *                         property="alias",
 *                         type="string",
 *                         description="Псевдоним (макс. 255 символов, уникальный)",
 *                         maxLength=255,
 *                         nullable=true
 *                     ),
 *                     @OA\Property(
 *                         property="image",
 *                         type="string",
 *                         format="binary",
 *                         description="Изображение для загрузки",
 *                         nullable=true
 *                     ),
 *                     @OA\Property(
 *                         property="index_show",
 *                         type="boolean",
 *                         description="Показывать на главной странице",
 *                         nullable=true
 *                     )
 *                 )
 *             )
 *         }
 *     ),
 * 
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(
 *                     property="id",
 *                     type="integer",
 *                     example=1,
 *                     description="Уникальный идентификатор бренда."
 *                 ),
 *                 @OA\Property(
 *                     property="title",
 *                     type="string",
 *                     example="Apple",
 *                     description="Название бренда."
 *                 ),
 *                 @OA\Property(
 *                     property="alias",
 *                     type="string",
 *                     example="apple",
 *                     description="Псевдоним бренда."
 *                 ),
 *                 @OA\Property(
 *                     property="image",
 *                     type="string",
 *                     example="/storage/products/image.jpg",
 *                     nullable=true,
 *                     description="Ссылка на изображение бренда. Может быть null."
 *                 ),
 *                 @OA\Property(
 *                     property="index_show",
 *                     type="boolean",
 *                     example=true,
 *                     description="Признак отображения бренда на начальной странице."
 *                 ),
 *                 @OA\Property(
 *                     property="created_at",
 *                     type="string",
 *                     format="date-time",
 *                     description="Дата и время создания записи."
 *                 ),
 *                 @OA\Property(
 *                     property="updated_at",
 *                     type="string",
 *                     format="date-time",
 *                     description="Дата и время последнего обновления записи."
 *                 )
 *             )
 *         )
 *     )
 * )
 * @OA\Get(
 *     path="/api/brands",
 *     summary="Список брендов",
 *     tags={"Brand"},
 * 
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(
 *                     property="collection",
 *                     type="array",
 *                     @OA\Items(
 *                         type="object",
 *                         @OA\Property(
 *                             property="id",
 *                             type="integer",
 *                             example=1,
 *                             description="Уникальный идентификатор бренда."
 *                         ),
 *                         @OA\Property(
 *                             property="title",
 *                             type="string",
 *                             example="Яблоко мое",
 *                             description="Название бренда."
 *                         ),
 *                         @OA\Property(
 *                             property="alias",
 *                             type="string",
 *                             example="iabloko-moe",
 *                             description="Псевдоним бренда."
 *                         ),
 *                         @OA\Property(
 *                             property="image",
 *                             type="string",
 *                             example="/storage/products/image.jpg",
 *                             nullable=true,
 *                             description="Ссылка на изображение бренда. Может быть null."
 *                         ),
 *                         @OA\Property(
 *                             property="index_show",
 *                             type="boolean",
 *                             example=true,
 *                             description="Признак отображения бренда на начальной странице."
 *                         ),
 *                         @OA\Property(
 *                             property="created_at",
 *                             type="string",
 *                             format="date-time",
 *                             example="2024-11-27T20:06:31.000000Z",
 *                             description="Дата и время создания записи."
 *                         ),
 *                         @OA\Property(
 *                             property="updated_at",
 *                             type="string",
 *                             format="date-time",
 *                             example="2024-11-27T20:06:31.000000Z",
 *                             description="Дата и время последнего обновления записи."
 *                         )
 *                     )
 *                 )
 *             )
 *         )
 *     )
 * )

 * @OA\Get(
 *     path="/api/brands/{brand}",
 *     summary="Единичный бренд (по id или alias)",
 *     tags={"Brand"},
 * 
 * @OA\Response(
 *     response=200,
 *     description="Успешный ответ с данными о бренде и связанных продуктах",
 *     @OA\JsonContent(
 *         type="object",
 *         @OA\Property(
 *             property="data",
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="title", type="string", example="Яблоко мое"),
 *             @OA\Property(property="alias", type="string", example="iabloko-moe"),
 *             @OA\Property(property="image", type="string", nullable=true, example=null),
 *             @OA\Property(property="index_show", type="integer", example=1),
 *             @OA\Property(property="created_at", type="string", format="date-time", example="2024-11-27T20:06:31.000000Z"),
 *             @OA\Property(property="updated_at", type="string", format="date-time", example="2024-11-27T20:06:31.000000Z")
 *         ),
 *         @OA\Property(
 *             property="products",
 *             type="object",
 *             @OA\Property(
 *                 property="collection",
 *                 type="array",
 *                 @OA\Items(
 *                     type="object",
 *                     @OA\Property(property="id", type="integer", example=1),
 *                     @OA\Property(property="title", type="string", example="Продукт"),
 *                     @OA\Property(property="alias", type="string", example="produkt"),
 *                     @OA\Property(
 *                         property="properties",
 *                         type="array",
 *                         @OA\Items(
 *                             type="object",
 *                             @OA\Property(property="id", type="integer", example=1),
 *                             @OA\Property(property="title", type="string", example="Скорость"),
 *                             @OA\Property(property="alias", type="string", example="skorost"),
 *                             @OA\Property(property="value", type="string", example="200"),
 *                             @OA\Property(property="data_type_id", type="integer", example=4),
 *                             @OA\Property(property="sort_order", type="integer", example=0),
 *                             @OA\Property(property="is_multiple", type="integer", example=0),
 *                             @OA\Property(property="is_selector", type="integer", example=0),
 *                             @OA\Property(property="show_in_characteristics", type="integer", example=0),
 *                             @OA\Property(property="show_in_filters", type="integer", example=0),
 *                             @OA\Property(property="created_at", type="string", format="date-time", example="2024-11-27T20:06:57.000000Z"),
 *                             @OA\Property(property="updated_at", type="string", format="date-time", example="2024-11-27T20:06:57.000000Z")
 *                         )
 *                     ),
 *                     @OA\Property(
 *                         property="images",
 *                         type="object",
 *                         @OA\Property(
 *                             property="collection",
 *                             type="array",
 *                             @OA\Items(
 *                                 type="object",
 *                                 @OA\Property(property="id", type="integer", example=13),
 *                                 @OA\Property(property="caption", type="string", example="Картинка 1"),
 *                                 @OA\Property(property="file_name", type="string", example="/storage/products/ucvH0OuZQFy8nHEGGDswkjKv0FcQwUThWyZGyx8A.jpg")
 *                             )
 *                         )
 *                     ),
 *                     @OA\Property(
 *                         property="documents",
 *                         type="object",
 *                         @OA\Property(
 *                             property="collection",
 *                             type="array",
 *                             @OA\Items(
 *                                 type="object",
 *                                 @OA\Property(property="id", type="integer", example=2),
 *                                 @OA\Property(property="caption", type="string", example="Документ"),
 *                                 @OA\Property(property="file_name", type="string", example="/storage/product_documents/HZ5UDZDfjmZEtxyjpORgJglB2tAA6T6JhYIWxFcX.txt")
 *                             )
 *                         )
 *                     ),
 *                     @OA\Property(property="category_id", type="integer", example=1),
 *                     @OA\Property(property="brand_id", type="integer", example=1),
 *                     @OA\Property(property="nomenclature_id", type="integer", example=1),
 *                     @OA\Property(property="tags", type="string", nullable=true, example=null),
 *                     @OA\Property(property="preview_image", type="string", nullable=true, example=null),
 *                     @OA\Property(property="description", type="string", nullable=true, example=null),
 *                     @OA\Property(property="access_level", type="integer", example=0),
 *                     @OA\Property(property="seo_title", type="string", nullable=true, example=null),
 *                     @OA\Property(property="seo_description", type="string", nullable=true, example=null),
 *                     @OA\Property(property="is_active", type="integer", example=1),
 *                     @OA\Property(property="gift", type="string", nullable=true, example=null),
 *                     @OA\Property(property="created_at", type="string", format="date-time", example="2024-11-27T20:07:45.000000Z"),
 *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-11-27T20:07:45.000000Z")
 *                 )
 *             )
 *         )
 *     )
 * )
 * )
 */

class BrandController extends Controller
{

}
