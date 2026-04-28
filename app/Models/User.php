<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Borrowing; 

class User extends Authenticatable
{
    // existing code...

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
public function activeBorrowings()
{
    return $this->hasMany(Borrowing::class)->where('status', 'active')->with('equipment');
}
}
