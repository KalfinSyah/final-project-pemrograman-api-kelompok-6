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
        $active_reservations = Reservation::with(['user', 'vendors', 'updatedBy'])
            ->where('reservation_status', '!=', 'Batal')
            ->where('wedding_date', '>=', now())
            ->get();

        $inactive_reservations = Reservation::with(['user', 'vendors', 'updatedBy'])
            ->where(function ($query) {
                $query->where('reservation_status', 'Batal')
                    ->orWhere('wedding_date', '<=', now());
            })
            ->get();

        return response()->json([
            'active_reservations' => ReservationResource::collection($active_reservations),
            'inactive_reservations' => ReservationResource::collection($inactive_reservations),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'wedding_contract_notes' => 'required|string',
            'reception_notes' => 'required|string',
            'wedding_package' => [
                'required',
                Rule::in(Reservation::PACKAGES),
            ],
            'reservation_status' => [
                'required',
                Rule::in(Reservation::STATUSES),
            ],
            'wedding_date' => 'required|date',
            'vendor_ids' => 'nullable|array',
            'vendor_ids.*' => 'exists:vendors,id',
            'combined_name' => 'required|string',
            'groom' => 'required|string',
            'bride' => 'required|string',
            'telephone_num' => 'required|string|max:15',
            'wedding_location' => 'sometimes|string|max:255'
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
        $reservation->load(['user', 'vendors', 'updatedBy', 'cashflows', 'activities']);
        return new ReservationResource($reservation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'wedding_contract_notes' => 'sometimes|required|string',
            'reception_notes' => 'sometimes|required|string',
            'wedding_package' => [
                'sometimes',
                'required',
                Rule::in(Reservation::PACKAGES),
            ],
            'reservation_status' => [
                'sometimes',
                'required',
                Rule::in(Reservation::STATUSES),
            ],
            'wedding_date' => 'sometimes|required|date',
            'vendor_ids' => 'nullable|array',
            'vendor_ids.*' => 'exists:vendors,id',
            'combined_name' => 'sometimes|required|string',
            'groom' => 'sometimes|required|string',
            'bride' => 'sometimes|required|string',
            'telephone_num' => 'sometimes|required|string|max:15',
            'wedding_location' => 'sometimes|string|max:255'
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
        abort(404);

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

    public function showClosest()
    {
        // Ambil reservasi dengan tanggal paling dekat dari hari ini
        $reservation = Reservation::whereDate('wedding_date', '>=', now())
            ->orderBy('wedding_date', 'asc')
            ->first();

        if (!$reservation) {
            return response()->json(['message' => 'Tidak ada reservasi yang akan datang'], 404);
        }

        $reservation->load(['user', 'vendors', 'updatedBy', 'cashflows', 'activities']);

        return new ReservationResource($reservation);
    }

    public function upcoming()
    {
        $reservations = Reservation::with(['user', 'vendors', 'updatedBy'])
            ->where('reservation_status', '!=', 'Batal')
            ->whereDate('wedding_date', '>', now())
            ->get();

        return ReservationResource::collection($reservations);
    }
}
