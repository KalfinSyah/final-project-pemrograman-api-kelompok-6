<?php

namespace App\Http\Controllers\Api;

use App\Models\Activity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\ActivitySimplifiedResource;

class ActivityController extends Controller
{
    public function __construct()
    {
        // Hanya method index yang boleh diakses publik
        $this->middleware(['auth:sanctum', 'is_admin'])->except('index');
    }

    public function index()
    {
        $activities = Activity::where('activity_type', 'Pelaksanaan Acara')->get();

        return ActivitySimplifiedResource::collection($activities);
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
