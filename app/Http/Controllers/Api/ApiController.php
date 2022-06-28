<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\CreateCatalogRequest;
use App\Http\Requests\DeleteCatalogRequest;
use App\Http\Requests\UpdateCatalogRequest;
use App\Http\Resources\CatalogCollection;
use App\Models\Catalog;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $catalog = Catalog::all();
        return response()->json([
            'status' => 'success',
            'catalog' => $catalog,
        ]);
    }

    public function getCatalogs(Request $request)
    {
        $count = Catalog::$count;
        $skip = 10;
        $limit = $count - $skip;

        try {
            $catalogs = Catalog::skip($skip)->take($limit)->get();
            return new CatalogCollection($catalogs);
        }
        catch (QueryException $e)
        {
            abort(400, $e->getMessage());
        }
    }

    public function createCatalog(CreateCatalogRequest $request)
    {
        try {
            $catalog = new Catalog;
            $catalog->name = $request->name;
            $catalog->description = $request->description;
            $catalog->category = $request->category;
            $catalog->price = $request->price;
            $catalog->save();
        }
        catch (QueryException $e)
        {
            abort(400, $e->getMessage());
        }
        return abort(200);
    }

    public function updateCatalog(UpdateCatalogRequest $request)
    {
        if($request->has('id')){
            try {
                $catalog = Catalog::whereId($request->id)->first();
                $catalog->name = $request->name;
                $catalog->description = $request->description;
                $catalog->category = $request->category;
                $catalog->price = $request->price;
                $catalog->save();
            }
            catch (QueryException $e)
            {
                abort(400, $e->getMessage());
            }
            return abort(200);
        }
        else{
            return abort(400);
        }
    }

    public function deleteCatalog(DeleteCatalogRequest $request)
    {
        if($request->has('id')){
            try{
                $catalog = Catalog::whereId($request->id)->delete();
            }
            catch (QueryException $e)
            {
                abort(400, $e->getMessage());
            }
            return abort(200);
        }
        else{
            return abort(400);
        }
    }
}
