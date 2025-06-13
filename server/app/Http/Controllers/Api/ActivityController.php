<?php

namespace App\Http\Controllers\Api;

use App\Models\Activity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ActivityResource;

class ActivityController extends Controller
{
    public function __construct()
    {
        // Hanya method index yang boleh diakses publik
        $this->middleware(['auth:sanctum', 'is_admin'])->except('index');
    }

    public function index()
    {
        return ActivityResource::collection(Activity::all());
    }

    public function store(Request $request)
    {
        $activity = Activity::create($request->all());
        return new ActivityResource($activity);
    }

    public function show(Activity $activity)
    {
        return new ActivityResource($activity);
    }

    public function update(Request $request, Activity $activity)
    {
        $activity->update($request->all());
        return new ActivityResource($activity);
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();
        return response()->noContent();
    }
}
