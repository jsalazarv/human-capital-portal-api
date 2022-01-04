<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $profiles = Profile::paginate($request->get('pageSize'));

        return ProfileResource::collection($profiles);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $profile = Profile::find($id);

        return response()->json($profile);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws \Throwable
     */
    public function update(Request $request, $id): JsonResponse
    {
        $profile = Profile::findOrFail($id);
        $profile->nickname = $request->get('nickname');
        $profile->lastname = $request->get('lastname');
        $profile->phone = $request->get('phone');
        $profile->address = $request->get('address');

        $profile->updateOrFail();
        return response()->json($profile);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
