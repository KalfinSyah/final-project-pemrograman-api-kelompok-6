<?php

namespace App\Http\Controllers\Api;

use App\Models\Activity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\ActivitySimplifiedResource;
use Illuminate\Validation\Rule;

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

    public function all()
    {
        $activities = Activity::with(['user', 'updatedBy'])->get();
        return ActivityResource::collection($activities);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'activity_type' => [
                'required',
                Rule::in(Activity::TYPES),
            ],
            'activity_status' => [
                'required',
                Rule::in(Activity::STATUSES),
            ],
            'activity_name' => 'required|string|max:100',
            'activity_date' => 'required|date',
            'activity_desc' => 'required|string',
            'reservation_id' => 'required|exists:reservations,id',
        ]);

        $validated['user_id'] = $request->user()->id;
        $validated['updated_by'] = $request->user()->id;

        $activity = Activity::create($validated);

        return new ActivityResource($activity);
    }

    public function show(Activity $activity)
    {
        $activity->load(['user', 'updatedBy']);
        return new ActivityResource($activity);
    }

    public function update(Request $request, Activity $activity)
    {
        $validated = $request->validate([
            'activity_type' => [
                'sometimes',
                'required',
                Rule::in(Activity::TYPES),
            ],
            'activity_status' => [
                'sometimes',
                'required',
                Rule::in(Activity::STATUSES),
            ],
            'activity_name' => 'sometimes|required|string|max:100',
            'activity_date' => 'sometimes|required|date',
            'activity_desc' => 'sometimes|required|string',
            'reservation_id' => 'sometimes|required|exists:reservations,id',
        ]);

        $validated['updated_by'] = $request->user()->id;

        $activity->update($validated);

        return new ActivityResource($activity);
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();

        return response()->json([
            'message' => 'Activity deleted successfully.'
        ]);
    }
}
