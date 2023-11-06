<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveEventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CalendarController extends Controller
{
    public function month(int $year = null, int $month = null,): AnonymousResourceCollection
    {
        $year = $year ?? now()->year;

        $events = Event::whereYear($year)
            ->whereMonth($month)
            ->orderBy('start')
            ->get();

        return EventResource::collection($events);
    }

    public function store(SaveEventRequest $request): EventResource
    {
        $event = Event::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'location' => $request->input('location'),
            'start' => $request->input('start'),
            'end' => $request->input('end'),
            'type' => $request->input('type'),
        ]);

        return new EventResource($event);
    }

    public function update(SaveEventRequest $request, Event $event): EventResource
    {
        $event->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'location' => $request->input('location'),
            'start' => $request->input('start'),
            'end' => $request->input('end'),
            'type' => $request->input('type'),
        ]);

        return new EventResource($event);
    }

    public function destroy(Event $event): EventResource
    {
        $event->delete();

        return new EventResource($event);
    }
}
