<?php

namespace App\Http\Controllers\Api;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReservationResource;
use App\Http\Resources\CashflowResource;
use Illuminate\Validation\Rule;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::with(['client', 'user', 'vendors', 'updatedBy'])->get();
        return ReservationResource::collection($reservations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'marriage_contract_notes' => 'required|string',
            'reception_notes' => 'required|string',
            'wedding_package' => [
                'required',
                Rule::in(Reservation::PACKAGES),
            ],
            'vendor_ids' => 'nullable|array',
            'vendor_ids.*' => 'exists:vendors,id',
        ]);

        $validated['user_id'] = $request->user()->id;
        $validated['updated_by'] = $request->user()->id;

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
        $reservation->load(['client', 'user', 'vendors', 'updatedBy']);
        return new ReservationResource($reservation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'marriage_contract_notes' => 'sometimes|required|string',
            'reception_notes' => 'sometimes|required|string',
            'wedding_package' => [
                'sometimes|required',
                Rule::in(Reservation::PACKAGES),
            ],
            'vendor_ids' => 'nullable|array',
            'vendor_ids.*' => 'exists:vendors,id',
        ]);

        $validated['updated_by'] = $request->user()->id;

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
        // Jika ada relasi pivot vendor, putuskan terlebih dahulu
        $reservation->vendors()->detach();

        $reservation->delete();

        return response()->json([
            'message' => 'Reservation deleted successfully.'
        ]);
    }

    public function cashflows($id)
    {
        $reservation = Reservation::with('cashflows')->findOrFail($id);

        return CashflowResource::collection($reservation->cashflows);
    }
}
