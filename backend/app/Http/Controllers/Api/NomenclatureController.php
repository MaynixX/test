<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttachPropertiesRequest;
use App\Http\Requests\StoreNomenclatureRequest;
use App\Http\Requests\UpdateNomenclatureRequest;
use App\Http\Resources\NomenclatureCollection;
use App\Http\Resources\NomenclatureResource;
use App\Http\Resources\ProductCollection;
use App\Models\Nomenclature;
use GuzzleHttp\Psr7\Request;

class NomenclatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            "data" => new NomenclatureCollection(Nomenclature::all())
        ], 200);
    }

    /**
     * Display a listing of the resource.
     */
    public function attachProperties(AttachPropertiesRequest $request, Nomenclature $nomenclature)
    {
        if($nomenclature->products()->count() != 0){
            return response()->json([
                "message" => "The nomenclature should not have associated products"
            ], 422);
        }
        $nomenclature->properties()->attach($request->validated()['properties']);
        return response()->json([
            "message" => "Properties was attached"
        ], 200);
    }
    /**
     * Display a listing of the resource.
     */
    public function detachProperties(AttachPropertiesRequest $request, Nomenclature $nomenclature)
    {
        if($nomenclature->products()->count() != 0){
            return response()->json([
                "message" => "The nomenclature should not have associated products"
            ], 422);
        }
        $nomenclature->properties()->detach($request->validated()['properties']);
        return response()->json([
            "message" => "Properties was detached"
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNomenclatureRequest $request)
    {
        $nomenclature = Nomenclature::create($request->validated());
        return response()->json([
            "data" => new NomenclatureResource($nomenclature)
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Nomenclature $nomenclature)
    {
        return response()->json([
            "data" => new NomenclatureResource($nomenclature),
            "products" => new ProductCollection($nomenclature->products)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNomenclatureRequest $request, Nomenclature $nomenclature)
    {
        $nomenclature->update($request->validated());
        return response()->json([
            "data" => new NomenclatureResource($nomenclature)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nomenclature $nomenclature)
    {
        $nomenclature->delete();
        return response()->json([
            "message" => "Nomenclature was deleted"
        ], 200);
    }
}
