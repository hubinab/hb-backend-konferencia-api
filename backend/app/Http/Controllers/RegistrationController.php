<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegistrationRequest;
use App\Http\Requests\UpdateRegistrationRequest;
use App\Http\Resources\RegistrationResource;
use App\Models\Registration;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResource
    {
        if (!in_array($orderBy = $request->query("orderBy"), ["name", "date", null]))
            abort(404);

        if (!in_array($order = $request->query("order"), ["asc", "desc", null]))
            abort(404);

        if ($orderBy === null and $order !==null) 
            abort(404);
        
        if ($orderBy !== null) {
            $order = $order ?? "asc";
            return RegistrationResource::collection(Registration::query()->orderBy($orderBy, $order)->get());
        } 
        else return RegistrationResource::collection(Registration::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRegistrationRequest $request): JsonResource
    {
        return new RegistrationResource(Registration::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Registration $registration): JsonResource
    {
        return new RegistrationResource($registration);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRegistrationRequest $request, Registration $registration): JsonResource
    {
        $data = $request->validated();
        $registration->update($data);
        return new RegistrationResource($registration);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Registration $registration): Response
    {
        return $registration->delete() ? response('Sikeres törlés', 204) : abort(500);
    }

    public function count(): JsonResponse
    {
        $count = Registration::count();
        return response()->json(["data" => $count]);
    }
}
