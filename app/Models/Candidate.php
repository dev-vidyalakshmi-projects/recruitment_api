<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidate extends Model
{
    use HasFactory;

    use SoftDeletes; // for soft delete

    protected $fillable = ['name', 'email', 'phone', 'resume'];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
