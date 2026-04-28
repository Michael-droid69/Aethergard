@extends('dashboard')

@section('content')
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

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="grid grid-cols-1 gap-6">
        @foreach($equipment as $item)
            <div id="card-{{ $item->id }}" class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden flex flex-col md:flex-row">
                <!-- Image container -->
                <div class="w-full md:w-40 h-48 bg-gray-100 flex items-center justify-center">
                    @if(!empty($item->image_url))
                        <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="object-cover w-full h-full">
                    @else
                        <div class="text-gray-400">Image</div>
                    @endif
                </div>

                <!-- Content -->
                <div class="p-4 flex-1">
                    <h2 class="text-lg font-semibold mb-1">{{ $item->name }}</h2>
                    <p class="text-sm text-gray-600 mb-3">{{ $item->description }}</p>
                    <div class="text-xs text-gray-500 mb-3">
                        <span class="mr-3">Tier: {{ $item->category ?? '—' }}</span>
                        <span>Status: <span id="status-{{ $item->id }}">{{ $item->is_borrowed ? 'Borrowed' : 'Available' }}</span></span>
                    </div>
                    <div class="text-sm text-gray-500">
                        <!-- extra stats placeholder -->
                    </div>
                </div>

                <!-- Actions -->
                <div class="p-4 w-full md:w-48 flex flex-col justify-center items-stretch">
                    @php
                        $myBorrowing = $item->activeBorrowing;
                        $isMine = $myBorrowing && $myBorrowing->user_id === auth()->id();
                    @endphp

                    <div id="action-{{ $item->id }}">
                        @if($item->is_borrowed && $isMine)
                            <div class="mb-3 px-3 py-2 rounded-lg text-sm font-semibold text-left"
                                 style="background: rgba(196,163,90,0.12); border: 1px solid #c4a35a; color: #6b4f10;">
                                ⏳ Due in <span id="days-{{ $item->id }}">{{ $myBorrowing->daysLeft() }}</span> days
                                · <span id="date-{{ $item->id }}">{{ optional($myBorrowing->due_date)->format('M d') }}</span>
                            </div>

                            <form method="POST" action="{{ route('borrowing.return', $myBorrowing) }}" class="return-form">
                                @csrf
                                <button type="submit"
                                        class="w-full px-4 py-2 rounded-lg font-bold text-sm transition hover:opacity-90"
                                        style="background:#3d1205; border:1px solid #c4a35a; color:#f5e6b0;">
                                    Return Item
                                </button>
                            </form>
                        @elseif($item->is_borrowed)
                            <div class="px-3 py-2 rounded-lg text-sm font-semibold text-center"
                                 style="background: rgba(80,20,10,0.12); border: 1px solid #8b3a2a; color: #7a3f2a;">
                                Currently Borrowed
                            </div>
                        @else
                            <form method="POST" action="{{ route('borrow', $item) }}" class="borrow-form" data-id="{{ $item->id }}">
                                @csrf
                                <button type="submit"
                                        id="borrow-btn-{{ $item->id }}"
                                        class="w-full px-4 py-2 rounded-lg font-bold text-sm transition hover:opacity-95"
                                        style="background: linear-gradient(135deg,#c4901a,#f0c842); color:#2a0d04;">
                                    ⚔ Borrow Item
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- AJAX script to handle borrow without full page reload -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Attach submit handlers to all borrow forms
    document.querySelectorAll('.borrow-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const id = form.dataset.id;
            const btn = document.getElementById('borrow-btn-' + id);
            btn.disabled = true;
            btn.textContent = 'Borrowing...';

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            })
            .then(async res => {
                if (res.status === 409) {
                    const json = await res.json();
                    btn.disabled = false;
                    btn.textContent = '⚔ Borrow Item';
                    alert(json.message || 'Already borrowed');
                    return;
                }
                if (!res.ok) {
                    btn.disabled = false;
                    btn.textContent = '⚔ Borrow Item';
                    const txt = await res.text();
                    console.error('Borrow error', txt);
                    alert('Error borrowing item');
                    return;
                }
                return res.json();
            })
            .then(json => {
                if (!json) return;
                // Update card UI to show due date + return button
                const action = document.getElementById('action-' + json.borrowing.equipment_id);
                if (action) {
                    action.innerHTML = `
                        <div class="mb-3 px-3 py-2 rounded-lg text-sm font-semibold text-left"
                             style="background: rgba(196,163,90,0.12); border: 1px solid #c4a35a; color: #6b4f10;">
                            ⏳ Due in <span id="days-${json.borrowing.equipment_id}">${json.borrowing.days_left}</span> days
                            · <span id="date-${json.borrowing.equipment_id}">${new Date(json.borrowing.due_date).toLocaleDateString(undefined, { month: 'short', day: '2-digit' })}</span>
                        </div>
                        <form method="POST" action="/borrowing/${json.borrowing.id}/return" class="return-form">
                            <input type="hidden" name="_token" value="${token}">
                            <button type="submit"
                                    class="w-full px-4 py-2 rounded-lg font-bold text-sm transition hover:opacity-90"
                                    style="background:#3d1205; border:1px solid #c4a35a; color:#f5e6b0;">
                                Return Item
                            </button>
                        </form>
                    `;
                }
                const status = document.getElementById('status-' + json.borrowing.equipment_id);
                if (status) status.textContent = 'Borrowed';
                // Optionally redirect to home instead of AJAX update:
                // window.location = "{{ route('home') }}";
            })
            .catch(err => {
                console.error(err);
                btn.disabled = false;
                btn.textContent = '⚔ Borrow Item';
                alert('Network error');
            });
        });
    });

    // Delegate return form submit (works for dynamically inserted forms)
    document.body.addEventListener('submit', function (e) {
        if (!e.target.matches('.return-form')) return;
        e.preventDefault();
        const form = e.target;
        const action = form.action;
        const btn = form.querySelector('button[type="submit"]');
        if (btn) {
            btn.disabled = true;
            btn.textContent = 'Returning...';
        }

        fetch(action, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': token,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({})
        })
        .then(async res => {
            if (!res.ok) {
                const txt = await res.text();
                console.error('Return error', txt);
                alert('Error returning item');
                if (btn) { btn.disabled = false; btn.textContent = 'Return Item'; }
                return;
            }
            return res.json();
        })
        .then(json => {
            if (!json) return;
            // Find the equipment id from the returned borrowing id by reading the card's action URL pattern
            // We used /borrowing/{id}/return; after return we need to update the card to show Borrow button again.
            // Simple approach: reload page to refresh home and index states
            window.location.reload();
        })
        .catch(err => {
            console.error(err);
            if (btn) { btn.disabled = false; btn.textContent = 'Return Item'; }
            alert('Network error');
        });
    });
});
</script>
@endsection
