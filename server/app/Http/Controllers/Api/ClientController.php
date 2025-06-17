<?php

namespace App\Http\Controllers\Api;

use App\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ClientResource;
use App\Http\Resources\ReservationResource;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return ClientResource::collection(Client::all());
        $client_active = Client::whereHas('reservations', function ($query) {
            $query->whereIn('reservation_status', ['berlangsung', 'pending']);
        })->get();

        $client_inactive = Client::whereDoesntHave('reservations', function ($query) {
            $query->whereIn('reservation_status', ['berlangsung', 'pending']);
        })->get();

        return response()->json([
            'client_active' => $client_active,
            'client_inactive' => $client_inactive,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'combined_name' => 'required|string',
            'groom' => 'required|string',
            'bride' => 'required|string',
            'telephone_num' => 'required|string|max:15',
        ]);

        $client = Client::create($validated);

        return new ClientResource($client);
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return new ClientResource($client);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'combined_name' => 'sometimes|required||string',
            'groom' => 'sometimes|required||string',
            'bride' => 'sometimes|required||string',
            'telephone_num' => 'sometimes|required||string|max:15',
        ]);

        $client->update($validated);

        return new ClientResource($client);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        abort(404);

        if ($client->reservations()->exists()) {
            return response()->json([
                'message' => 'Client ini masih digunakan dalam salah satu atau lebih reservasi dan tidak dapat dihapus.'
            ], 409);
        }

        $client->delete();

        return response()->json([
            'message' => 'Client berhasil dihapus.'
        ]);

        // $reservations = $client->reservations()->pluck('id');

        // return response()->json([
        //     'message' => 'Client ini digunakan pada reservasi berikut.',
        //     'reservations' => $reservations,
        // ], 409);
    }

    public function reservations($id)
    {
        $client = Client::with('reservations')->findOrFail($id);

        // return ReservationResource::collection($client->reservations);

        return response()->json([
            'client' => $client->only(['id', 'combined_name']),
            'reservations' => $client->reservations
        ]);
    }
}
