<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function stage()
    {
        return $this->belongsTo(InterviewStage::class, 'stage_id');
    }
}
