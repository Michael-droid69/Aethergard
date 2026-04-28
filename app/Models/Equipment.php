<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $fillable = ['name','category','description','status','image_url'];

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    // Relation you can eager load (considered "currently borrowed" = active or overdue)
    public function latestActiveBorrowing()
    {
        return $this->hasOne(Borrowing::class)
            ->whereIn('status', ['active', 'overdue'])
            ->latestOfMany('borrowed_at');
    }

    // Accessor used in Blade: $item->activeBorrowing
    public function getActiveBorrowingAttribute()
    {
        if ($this->relationLoaded('latestActiveBorrowing')) {
            return $this->getRelation('latestActiveBorrowing');
        }

        return $this->borrowings()
            ->whereIn('status', ['active', 'overdue'])
            ->latest('borrowed_at')
            ->first();
    }

    // Boolean accessor: $item->is_borrowed
    public function getIsBorrowedAttribute()
    {
        return $this->activeBorrowing !== null;
    }

    // Backwards-compatible method call
    public function activeBorrowing()
    {
        return $this->activeBorrowing;
    }
}
