<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Borrowing extends Model
{
    protected $fillable = [
        'user_id', 'equipment_id',
        'borrowed_at', 'due_date',
        'returned_at', 'status', 'notes'
    ];

    protected $casts = [
        'borrowed_at' => 'datetime',
        'due_date'    => 'datetime',
        'returned_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    public function daysLeft(): int
    {
        if (! $this->due_date) {
            return 0;
        }

        return max(0, now()->diffInDays($this->due_date, false));
    }

    public function isOverdue(): bool
    {
        // DB statuses: active / returned / overdue
        // Treat "active" + past due as overdue for UI purposes.
        return $this->due_date
            && now()->isAfter($this->due_date)
            && in_array($this->status, ['active', 'overdue'], true);
    }
}
