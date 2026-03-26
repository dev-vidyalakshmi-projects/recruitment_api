<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Services\JobService;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use Illuminate\Support\Facades\Log;

class JobController extends Controller
{

    public function __construct(JobService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $jobs = $this->service->list($request->all());
        return response()->json($jobs);
        // return response()->json(Job::latest()->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobRequest $request)
    {
        Log::info('Incoming Job Data', $request->all());
        $job = $this->service->create($request->validated());
        Log::info('Job Created', ['job_id' => $job->id]);
        return response()->json([
            'message' => 'Job created successfully',
            'data' => $job
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        return response()->json($job);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobRequest $request, Job $job)
    {
        $job = $this->service->update($job, $request->validated());

        return response()->json([
            'message' => 'Job updated successfully',
            'data' => $job
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        $this->service->delete($job);

        return response()->json([
            'message' => 'Job deleted (soft) successfully'
        ]);
    }
}
