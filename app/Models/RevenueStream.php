<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RevenueStream extends Model
{
    use HasFactory;

    protected $table = 'revenue_streams';

    protected $fillable = [
        'unit_id',
        'name',
        'category',
        'target_amount',
        'realization_amount',
        'contribution_percentage',
        'growth_rate',
        'period',
        'status',
        'proof_file',
        'approval_status',
        'rejection_reason',
        'approved_by',
    ];

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function getProofFileUrlAttribute(): ?string
    {
        if ($this->proof_file) {
            return asset('storage/' . $this->proof_file);
        }
        return null;
    }
}
