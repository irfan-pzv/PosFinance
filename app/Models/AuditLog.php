<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AuditLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_name',
        'user_email',
        'action',
        'description',
        'ip_address',
        'user_agent',
    ];

    // Relationship to User model.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Helper method to record an audit log entry.
    public static function record(string $action, string $description, ?User $user = null): self
    {
        $user = $user ?? Auth::user();
        $request = request();

        return static::create([
            'user_id' => $user?->id,
            'user_name' => $user?->name ?? 'System',
            'user_email' => $user?->email ?? 'system@posfinance.co.id',
            'action' => strtoupper($action),
            'description' => $description,
            'ip_address' => $request ? $request->ip() : '127.0.0.1',
            'user_agent' => $request ? $request->userAgent() : 'System CLI',
        ]);
    }
}
