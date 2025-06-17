<?php

namespace App\Http\Controllers\Api;

use App\Models\Cashflow;
use App\Models\Reservation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CashflowResource;
use App\Http\Resources\CashflowGroupResource;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class CashflowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cashflows = Cashflow::with(['user', 'updatedBy'])->get();

        return CashflowResource::collection($cashflows);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cashflow_type' => [
                'required',
                Rule::in(Cashflow::TYPES),
            ],
            'amount' => 'required|numeric|regex:/^\d{1,13}(\.\d{1,2})?$/',
            'cashflow_date' => 'required|date',
            'cashflow_desc' => 'required|string',
            'reservation_id' => 'required|exists:reservations,id',
        ]);

        $validated['user_id'] = $request->user()->id;
        $validated['updated_by'] = $request->user()->id;

        $cashflow = Cashflow::create($validated);

        Reservation::all()->each(function ($reservation) {
            $in = Cashflow::where('reservation_id', $reservation->id)
                ->where('cashflow_type', 'Pendapatan')
                ->sum('amount');

            $out = Cashflow::where('reservation_id', $reservation->id)
                ->where('cashflow_type', 'Pengeluaran')
                ->sum('amount');

            $reservation->update([
                'cashflow_in' => $in,
                'cashflow_out' => $out
            ]);
        });

        return new CashflowResource($cashflow);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cashflow $cashflow)
    {
        $cashflow->load(['user', 'updatedBy']);
        return new CashflowResource($cashflow);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cashflow $cashflow)
    {
        $validated = $request->validate([
            'cashflow_type' => [
                'sometimes',
                'required',
                Rule::in(Cashflow::TYPES),
            ],
            'amount' => 'sometimes|required|numeric|regex:/^\d{1,13}(\.\d{1,2})?$/',
            'cashflow_date' => 'sometimes|required|date',
            'cashflow_desc' => 'sometimes|required|string',
            'reservation_id' => 'sometimes|required|exists:reservations,id',
        ]);

        $validated['updated_by'] = $request->user()->id;

        $cashflow->update($validated);

        Reservation::all()->each(function ($reservation) {
            $in = Cashflow::where('reservation_id', $reservation->id)
                ->where('cashflow_type', 'Pendapatan')
                ->sum('amount');

            $out = Cashflow::where('reservation_id', $reservation->id)
                ->where('cashflow_type', 'Pengeluaran')
                ->sum('amount');

            $reservation->update([
                'cashflow_in' => $in,
                'cashflow_out' => $out
            ]);
        });

        return new CashflowResource($cashflow);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cashflow $cashflow)
    {
        // Abort 404 Untuk Saat ini
        abort(404);

        $cashflow->delete();

        Reservation::all()->each(function ($reservation) {
            $in = Cashflow::where('reservation_id', $reservation->id)
                ->where('cashflow_type', 'Pendapatan')
                ->sum('amount');

            $out = Cashflow::where('reservation_id', $reservation->id)
                ->where('cashflow_type', 'Pengeluaran')
                ->sum('amount');

            $reservation->update([
                'cashflow_in' => $in,
                'cashflow_out' => $out
            ]);
        });

        return response()->json([
            'message' => 'Cashflow deleted successfully.'
        ]);
    }

    public function recentCashflows()
    {
        $startDate = now()->subMonths(3)->startOfMonth();
        $cashflows = Cashflow::where('cashflow_date', '>=', $startDate)->get();

        return new CashflowGroupResource($cashflows);
    }
}
