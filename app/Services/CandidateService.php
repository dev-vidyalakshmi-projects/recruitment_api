<?php

namespace App\Services;

use App\Models\Candidate;

class CandidateService
{
    public function create($data)
    {
        return Candidate::create($data);
    }

    public function update($Candidate, $data)
    {
        $Candidate->update($data);
        return $Candidate;
    }

    public function delete($Candidate)
    {
        $Candidate->delete();
        return true;
    }

    public function list($filters)
    {
        $query = Candidate::query();

        if (!empty($filters['search'])) {
            $query->where('name', 'LIKE', '%' . $filters['search'] . '%');
        }

        if (!empty($filters['email'])) {
            $query->where('email', $filters['email']);
        }

        if (!empty($filters['phone'])) {
            $query->where('phone', $filters['phone']);
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
