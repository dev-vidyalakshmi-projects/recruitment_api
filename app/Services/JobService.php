<?php

namespace App\Services;

use App\Models\Job;

class JobService
{
    public function create($data)
    {
        return Job::create($data);
    }

    public function update($job, $data)
    {
        $job->update($data);
        return $job;
    }

    public function delete($job)
    {
        $job->delete();
        return true;
    }

    public function list($filters)
    {
        $query = Job::query();

        if (!empty($filters['search'])) {
            $query->where('title', 'LIKE', '%' . $filters['search'] . '%');
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['sort'])) {
            $direction = $filters['direction'] ?? 'desc';
            $query->orderBy($filters['sort'], $direction);
        } else {
            $query->latest();
        }

        return $query->paginate(10);
    }

}
