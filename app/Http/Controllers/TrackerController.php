<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Tracker;
use App\Http\Requests\StoreTrackerRequest;
use App\Http\Requests\UpdateTrackerRequest;

class TrackerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tracker = Tracker::latest()->get();
        return view('Admin.Tracker.Index', [
            'tracker' => $tracker
        ]);
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
    public function store(StoreTrackerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Tracker $tracker)
    {
        $tracker = Tracker::where('id', $tracker->id)->first();

        return view('Admin.Tracker.show', [
            'tracker' => $tracker,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tracker $tracker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTrackerRequest $request, Tracker $tracker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tracker $tracker)
    {
        //
    }
}
