<?php

namespace App\Http\Controllers\Api;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReservationResource;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'user_id' => 'required|exists:users,id',
            'marriage_contract_notes' => 'required|string',
            'reception_notes' => 'required|string',
            'cashflow_in' => 'required|numeric',
            'cashflow_out' => 'required|numeric',
            'wedding_package' => 'required|string',
            'vendor_ids' => 'nullable|array',
            'vendor_ids.*' => 'exists:vendors,id',
        ]);

        $reservation = Reservation::create($validated);

        // Attach vendors if any
        if ($request->has('vendor_ids')) {
            $reservation->vendors()->attach($request->vendor_ids);
        }

        return new ReservationResource($reservation->load('vendors'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'client_id' => 'sometimes|exists:clients,id',
            'user_id' => 'sometimes|exists:users,id',
            'marriage_contract_notes' => 'sometimes|string',
            'reception_notes' => 'sometimes|string',
            'cashflow_in' => 'sometimes|numeric',
            'cashflow_out' => 'sometimes|numeric',
            'wedding_package' => 'sometimes|string',
            'vendor_ids' => 'nullable|array',
            'vendor_ids.*' => 'exists:vendors,id',
        ]);

        $reservation->update($validated);

        // Sync vendors if provided
        if ($request->has('vendor_ids')) {
            $reservation->vendors()->sync($request->vendor_ids);
        }

        return new ReservationResource($reservation->load('vendors'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
