<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PokemonStoreRequest;
use App\Http\Resources\PokemonResource;
use App\Models\Pokemon;
use GuzzleHttp\Psr7\Response;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response as ResponseAlias;

class PokemonController extends Controller
{

    /**
     * @return AnonymousResourceCollection
     */
    public function index():AnonymousResourceCollection
    {
        return PokemonResource::collection(Pokemon::all());
    }

    /**
     * @param Request $request
     * @return PokemonResource
     */
    public function store(PokemonStoreRequest $request):PokemonResource
    {
        $createPokemon = Pokemon::create($request->validated());
        return new PokemonResource($createPokemon);
    }


    public function show($id)
    {
        return new PokemonResource(Pokemon::findOrFail($id));
    }

    /**
     * @param PokemonStoreRequest $request
     * @param Pokemon $pokemon
     * @return PokemonResource
     */
    public function update(PokemonStoreRequest $request, Pokemon $pokemon)
    {
        $pokemon->update($request->validated());
        return new PokemonResource($pokemon);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pokemon $pokemon)
    {
        $pokemon->delete();
        return response(ResponseAlias::HTTP_NO_CONTENT, null);
    }

    public function paginate()
    {
        $pokemon = Pokemon::paginate(5);
        return response()->json($pokemon);
    }
}
