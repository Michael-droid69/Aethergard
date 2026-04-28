@extends('dashboard')

@section('content')
<!--
  Equipment index — right-aligned content area.
  If your sidebar width is different, change the ml-64 class to match (e.g., ml-56, ml-72).
-->
<div class="ml-64 p-6"> <!-- adjust ml-64 to match your sidebar width -->
    <h1 class="text-2xl font-bold mb-6">Equipment</h1>

    @if(session('success'))
        <div class="mb-4 p-3 rounded bg-green-100 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-3 rounded bg-red-100 text-red-800">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 gap-6">
        @foreach($equipment as $item)
            <div class="flex items-start justify-between mb-0 p-4 rounded-lg border border-gray-200 shadow-sm bg-white">
                <div class="pr-6 flex-1">
                    <h2 class="text-lg font-semibold mb-1">{{ $item->name }}</h2>
                    <p class="text-sm text-gray-600 mb-3">{{ $item->description }}</p>
                    <div class="text-xs text-gray-500">
                        <span class="mr-3">Category: {{ $item->category ?? '—' }}</span>
                        <span>Status: {{ $item->is_borrowed ? 'Borrowed' : 'Available' }}</span>
                    </div>
                </div>

                <div class="flex-shrink-0 w-56 text-right">
                    {{-- Borrow / Return logic --}}
                    @if($item->is_borrowed)
                       @php
    $myBorrowing = $item->activeBorrowing;
    $isMine = $myBorrowing && $myBorrowing->user_id === auth()->id();
@endphp

                        @if($isMine)
                            <div class="mb-3 inline-block px-4 py-2 rounded-lg font-semibold text-sm"
                                 style="background: rgba(196,163,90,0.12); border: 1px solid #c4a35a; color: #6b4f10;">
                                ⏳ Due in {{ $myBorrowing->daysLeft() }} days
                                · {{ $myBorrowing->due_date->format('M d') }}
                            </div>

                            <form method="POST" action="{{ route('borrowing.return', $myBorrowing) }}" class="inline-block">
                                @csrf
                                <button type="submit"
                                        class="w-full px-4 py-2 rounded-lg font-bold text-sm transition hover:opacity-90"
                                        style="background:#3d1205; border:1px solid #c4a35a; color:#f5e6b0;">
                                    Return Item
                                </button>
                            </form>
                        @else
                            <div class="px-4 py-2 rounded-lg text-sm font-semibold"
                                 style="background: rgba(80,20,10,0.12); border: 1px solid #8b3a2a; color: #7a3f2a;">
                                Currently Borrowed
                            </div>
                        @endif
                    @else
                        <form method="POST" action="{{ route('borrow', $item) }}">
                            @csrf
                            <button type="submit"
                                    class="w-full px-4 py-2 rounded-lg font-bold text-sm transition hover:opacity-95"
                                    style="background: linear-gradient(135deg,#c4901a,#f0c842); color:#2a0d04;">
                                ⚔ Borrow Item
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
