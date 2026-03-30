<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Services\CandidateService;
use App\Http\Requests\StoreCandidateRequest;
use App\Http\Requests\UpdateCandidateRequest;
use Illuminate\Support\Facades\Log;

class CandidateController extends Controller
{

    public function __construct(CandidateService $service)
    {
         Log::info('Incoming application Data 1');
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $candidates = $this->service->list($request->all());
        return response()->json($candidates);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCandidateRequest $request)
    {
        Log::info('Incoming Candidate Data', $request->all());
        $data = $request->validated();
        if ($request->hasFile('resume')) {
            $file = $request->file('resume');
            $path = $file->store('resumes', 'public');
            $data['resume'] = $path;
        }
        $candidate = $this->service->create($data);
        Log::info('Candidate Created', ['candidate_id' => $candidate->id]);
        return response()->json([
            'message' => 'Candidate created successfully',
            'data' => $candidate
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Candidate $candidate)
    {
        return response()->json($candidate);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCandidateRequest $request, Candidate $candidate)
    {
        $data = $request->validated();
        if ($request->hasFile('resume')) {
            if ($candidate->resume && Storage::disk('public')->exists($candidate->resume)) {
                Storage::disk('public')->delete($candidate->resume);
            }
            $file = $request->file('resume');

            $path = $file->store('resumes', 'public');

            $data['resume'] = $path;
        }
        Log::info($request->all());
        Log::info($request->validated());
        $candidate = $this->service->update($candidate, $data);

        return response()->json([
            'message' => 'Candidate updated successfully',
            'data' => $candidate
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidate $candidate)
    {
         $this->service->delete($candidate);

        return response()->json([
            'message' => 'Candidate deleted (soft) successfully'
        ]);
    }
}
