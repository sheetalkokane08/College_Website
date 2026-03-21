<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'faculty_id',
        'approved',
    ];

    /**
     * The faculty member who created the notice
     */
    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    /**
     * Scope for approved notices
     */
    public function scopeApproved($query)
    {
        return $query->where('approved', true);
    }
}
