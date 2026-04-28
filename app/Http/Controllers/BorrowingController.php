<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorrowingController extends Controller
{
    public function borrow(Request $request, Equipment $equipment)
    {
        // Server-side guard: prevent double borrow
        if ($equipment->is_borrowed) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Already borrowed'], 409);
            }
            return back()->with('error', 'Item already borrowed.');
        }

        $borrowing = DB::transaction(function () use ($equipment) {
            $borrowing = Borrowing::create([
                'user_id' => auth()->id(),
                'equipment_id' => $equipment->id,
                'borrowed_at' => now(),
                'due_date' => now()->addDays(5),
                // MUST match DB enum values: active/returned/overdue
                'status' => 'active',
            ]);

            // Keep equipment flags in sync for UI
            $equipment->update([
                'is_borrowed' => true,
                // optional: if you use equipment.status, update it too
                // 'status' => 'borrowed',
            ]);

            return $borrowing;
        });

        // If AJAX, return JSON with borrowing info
        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'borrowed',
                'borrowing' => [
                    'id' => $borrowing->id,
                    'due_date' => $borrowing->due_date->toDateTimeString(),
                    'days_left' => $borrowing->daysLeft(),
                    'equipment_id' => $borrowing->equipment_id,
                ]
            ]);
        }

        return redirect()->route('home')->with('success', 'Item borrowed! Due in 5 days.');
    }

    public function return(Request $request, Borrowing $borrowing)
    {
        if ($borrowing->user_id !== auth()->id()) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Not authorized'], 403);
            }
            return back()->with('error', 'Not authorized.');
        }

        $borrowing->update([
            'returned_at' => now(),
            'status' => 'returned',
        ]);

        // Keep equipment flags in sync for UI
        $borrowing->equipment()->update([
            'is_borrowed' => false,
            // optional: if you use equipment.status, update it too
            // 'status' => 'available',
        ]);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'returned', 'borrowing_id' => $borrowing->id]);
        }

        return redirect()->route('home')->with('success', 'Item returned.');
    }
    // Add after the return() method

public function show(Request $request, Borrowing $borrowing)
{
    // Make sure the borrowing belongs to current user
    if ($borrowing->user_id !== auth()->id()) {
        return response()->json(['message' => 'Not authorized'], 403);
    }

    return response()->json([
        'id'          => $borrowing->id,
        'item_name'   => $borrowing->equipment->name,
        'item_type'   => $borrowing->equipment->type ?? 'Equipment',
        'borrowed_at' => $borrowing->borrowed_at->format('M d, Y'),
        'due_date'    => $borrowing->due_date->format('M d, Y'),
        'days_left'   => $borrowing->daysLeft(),
        'is_overdue'  => $borrowing->isOverdue(),
        'status'      => $borrowing->status,
    ]);
}

public function extend(Request $request, Borrowing $borrowing)
{
    if ($borrowing->user_id !== auth()->id()) {
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Not authorized'], 403);
        }
        return back()->with('error', 'Not authorized.');
    }

    if ($borrowing->status !== 'active') {
        return back()->with('error', 'Can only extend active borrowings.');
    }

    $borrowing->update([
        'due_date' => $borrowing->due_date->addDays(3),
    ]);

    if ($request->wantsJson()) {
        return response()->json([
            'message'   => 'extended',
            'due_date'  => $borrowing->due_date->format('M d, Y'),
            'days_left' => $borrowing->daysLeft(),
        ]);
    }

    return redirect()->route('home')->with('success', 'Borrowing extended by 3 days.');
}
}
