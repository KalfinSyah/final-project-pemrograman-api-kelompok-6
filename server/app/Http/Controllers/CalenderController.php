<?php

namespace App\Http\Controllers;

use App\Models\Calender;
use Illuminate\Http\Request;

class CalenderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->is_admin) {
            // Admin bisa melihat semua
            $calenders = Calender::all();
        } else {
            // User biasa hanya melihat tipe tertentu
            $calenders = Calender::where('calender_name', 'Pelaksanaan Acara')->get();
        }

        // return response()->json($calenders);
        return response()->json([
            'message' => 'Daftar Kegiatan Di Kalender',
            'data' => $calenders
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Calender $calender)
    {
        $calender->load('reservation');

        return response()->json([
            'message' => 'Detail Kalender',
            'data' => $calender
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Calender $calender)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Calender $calender)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Calender $calender)
    {
        //
    }
}
