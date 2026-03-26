<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InterviewStageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stages = [
            'REC-Sent2TL',
            'TL-Shortlisted',
            'TL-Rejected',
            'TL-Duplicate',
            'TL-ValidationFailed',
            'TL-Sent2Client',
            'CLIENT-Shortlisted',
            'CLIENT-Rejected',
            'CLIENT-Duplicate',
            'CLIENT-OnHold',
            'CLIENT-REQ-Closed',
            'CLIENT-REQ-Changed',
            'PRE-SCHD-CandidateNotReach',
            'PRE-SCHD-CandidateInt-OnHold',
            'PRE-SCHD-CandidateNotInt',
            'PRE-SCHD-TL-ValidationFailed',
            'PRE-SCHD-REQ-Closed',
            'INT-SCHD',
            'INT-ReSCHD-CLIENT',
            'INT-ReSCHD-Candidate',
            'INT-SCHD-Attended',
            'INT-SCHD-NotAttended',
            'INT-SCHD-TL-ValidationFailed',
            'INT-SCHD-REQ-Closed',
            'INT-STATUS-Shortlisted',
            'INT-STATUS-Offered',
            'INT-STATUS-Rejected',
            'INT-STATUS-OnHold',
            'INT-STATUS-REQ-Closed',
            'OFFER-Accepted',
            'OFFER-Declined',
            'OFFER-CandidateNotJoined',
            'NA'
        ];

        foreach ($stages as $index => $stage) {
            DB::table('interview_stages')->insert([
                'name' => $stage,
                'order' => $index + 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
