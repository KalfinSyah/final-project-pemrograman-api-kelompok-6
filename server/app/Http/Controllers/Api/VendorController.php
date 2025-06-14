<?php

namespace App\Http\Controllers\Api;

use App\Models\Vendor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\VendorResource;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendors = Vendor::with(['reservations'])->get();
        return VendorResource::collection($vendors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'vendor_type' => 'required|string',
            'vendor_brand' => 'required|string',
        ]);

        $vendor = Vendor::create($validated);

        return new VendorResource($vendor);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor)
    {
        return new VendorResource($vendor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vendor $vendor)
    {
        $validated = $request->validate([
            'vendor_type' => 'sometimes|required|string',
            'vendor_brand' => 'sometimes|required|string',
        ]);

        $vendor->update($validated);

        return new VendorResource($vendor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        if ($vendor->reservations()->exists()) {
            return response()->json([
                'message' => 'Vendor ini masih digunakan di salah satu atau lebih reservasi dan tidak dapat dihapus.'
            ], 409); // 409 Conflict
        }

        $vendor->delete();

        return response()->json([
            'message' => 'Vendor berhasil dihapus.'
        ]);

        // $reservations = $client->reservations()->pluck('id');

        // return response()->json([
        //     'message' => 'Client ini digunakan pada reservasi berikut.',
        //     'reservations' => $reservations,
        // ], 409);
    }
}
