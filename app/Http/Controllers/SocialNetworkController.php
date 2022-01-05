<?php

namespace App\Http\Controllers;

use App\Http\Resources\SocialNetworkResource;
use App\Models\SocialNetwork;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SocialNetworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $socialNetworks = SocialNetwork::paginate($request->get('pageSize'));

        return SocialNetworkResource::collection($socialNetworks);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $socialNetworks = SocialNetwork::find($id);

        return response()->json($socialNetworks);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $socialNetworks = SocialNetwork::findOrFail($id);

        $socialNetworks->name = $request->get('name');
        $socialNetworks->nickname = $request->get('nickname');
        $socialNetworks->link = $request->get('link');

        $socialNetworks->updateOrFail();
        return response()->json($socialNetworks);
    }
}
