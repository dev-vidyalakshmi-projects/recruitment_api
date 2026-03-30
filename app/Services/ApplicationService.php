<?php

namespace App\Services;

use App\Models\Application;

class ApplicationService
{
    public function apply($data)
    {
        $exists = Application::where('candidate_id', $data['candidate_id'])
            ->where('job_id', $data['job_id'])
            ->exists();

        if ($exists) {
            throw new \Exception('Candidate already applied');
        }

        return Application::create([
            'candidate_id' => $data['candidate_id'],
            'job_id' => $data['job_id'],
            'status' => 'applied'
        ]);
    }
}
