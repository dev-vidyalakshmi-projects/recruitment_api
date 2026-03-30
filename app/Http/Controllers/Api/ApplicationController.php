<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Services\ApplicationService;
use App\Http\Requests\StoreApplicationRequest;
use Illuminate\Support\Facades\Log;

class ApplicationController extends Controller
{
    public function __construct(ApplicationService $service) {
        Log::info('Incoming application Data 1');
         $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Application::latest()->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApplicationRequest $request)
    {
        Log::info('Incoming application Data', $request->all());
        $application = $this->service->apply($request->validated());

        return response()->json([
            'message' => 'Application submitted',
            'data' => $application
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
