<x-app-layout>
    <x-sidebar />

    <main class="ml-64 min-h-screen font-serif" style="background: #e8e0d4; background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23c4b89a\' fill-opacity=\'0.08\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">

        <div class="p-8">

            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-4xl font-bold tracking-wide" style="color: #2c1a0e; font-family: 'Palatino Linotype', Palatino, serif; letter-spacing: 0.05em;">
                    Guild Hall Dashboard
                </h1>
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <input type="text" placeholder="Search the archives..." class="pl-4 pr-10 py-2 rounded-full border text-sm" style="background: rgba(255,255,255,0.6); border-color: #c4a35a; color: #3d2b1f; width: 220px; font-family: inherit;">
                        <svg class="absolute right-3 top-2.5 w-4 h-4" style="color: #8a6a2e;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <button class="p-2 rounded-full hover:bg-yellow-100 transition" style="color: #8a6a2e;">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    </button>
                    <button class="p-2 rounded-full hover:bg-yellow-100 transition" style="color: #8a6a2e;">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </button>
                    <button class="p-2 rounded-full hover:bg-yellow-100 transition" style="color: #8a6a2e;">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </button>
                </div>
            </div>

           @include('partials.map-section')


            <!-- BOTTOM ROW: Quests + Active Borrowings -->
            <div class="grid grid-cols-3 gap-6">

                <!-- Guild Quests (2/3 width) -->
                <div class="col-span-2">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" style="color: #4a3520;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            <span class="font-bold text-base" style="color: #2c1a0e; font-family: 'Palatino Linotype', Palatino, serif;">Guild Quests</span>
                        </div>
                        <a href="#" class="text-xs font-bold tracking-widest hover:opacity-70 transition" style="color: #c4a35a; letter-spacing: 0.15em;">VIEW ALL CONTRACTS</a>
                    </div>

                    <div class="grid grid-cols-2 gap-5">

                        <!-- Quest Card 1 -->
                        <div class="relative" style="transform: rotate(-1.5deg);">
                            <!-- Paper stack shadow layers -->
                            <div class="absolute inset-0 rounded-lg" style="background: linear-gradient(135deg, #b8d4c8, #d4e8d8); transform: rotate(1.5deg) translateY(3px); z-index: 1; border: 1px solid rgba(255,255,255,0.4);"></div>
                            <div class="absolute inset-0 rounded-lg" style="background: linear-gradient(135deg, #c4dcd0, #dcecd8); transform: rotate(0.5deg) translateY(1px); z-index: 2; border: 1px solid rgba(255,255,255,0.4);"></div>
                            <!-- Main card -->
                            <div class="relative rounded-lg p-6 shadow-lg" style="background: linear-gradient(145deg, #7ab8c8 0%, #a8ccd4 30%, #c8dfc4 70%, #d4e8bc 100%); border: 1px solid rgba(255,255,255,0.5); z-index: 3; min-height: 260px;">
                                <!-- G.H. Stamp -->
                                <div class="absolute -top-4 left-1/2 -translate-x-1/2 w-10 h-10 rounded-full flex items-center justify-center shadow-md" style="background: linear-gradient(135deg, #8b1a1a, #cc2222); border: 2px solid #f5c842; z-index: 10;">
                                    <span class="text-white font-bold" style="font-size: 9px; letter-spacing: 0.05em;">G.H.</span>
                                </div>
                                <!-- Shine overlay -->
                                <div class="absolute inset-0 rounded-lg" style="background: linear-gradient(135deg, rgba(255,255,255,0.25) 0%, transparent 50%); pointer-events: none;"></div>

                                <h3 class="font-bold text-xl mt-3 mb-3" style="color: #1a2e3a; font-family: 'Palatino Linotype', Palatino, serif; line-height: 1.3;">The Silence of Shadow-Creek</h3>

                                <p class="text-sm italic mb-4" style="color: #2a3a30; line-height: 1.6; font-family: 'Palatino Linotype', Palatino, serif;">
                                    "Reports of missing livestock near the mill. Investigate and clear the area of any necrotic residue."
                                </p>

                                <!-- Divider -->
                                <div class="my-3" style="border-top: 1px solid rgba(180,160,100,0.5);"></div>

                                <div class="flex items-center justify-between mt-auto">
                                    <span class="font-bold text-sm" style="color: #c4881a; font-family: 'Palatino Linotype', Palatino, serif;">Reward: 400 Gold</span>
                                    <div class="flex items-center gap-1 text-xs" style="color: #2a3a30;">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2"/></svg>
                                        <span>2 Days Left</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quest Card 2 -->
                        <div class="relative" style="transform: rotate(1.2deg);">
                            <!-- Paper stack shadow layers -->
                            <div class="absolute inset-0 rounded-lg" style="background: linear-gradient(135deg, #b8d4c8, #d4e8d8); transform: rotate(-1.5deg) translateY(3px); z-index: 1; border: 1px solid rgba(255,255,255,0.4);"></div>
                            <div class="absolute inset-0 rounded-lg" style="background: linear-gradient(135deg, #c4dcd0, #dcecd8); transform: rotate(-0.5deg) translateY(1px); z-index: 2; border: 1px solid rgba(255,255,255,0.4);"></div>
                            <!-- Main card -->
                            <div class="relative rounded-lg p-6 shadow-lg" style="background: linear-gradient(145deg, #6aaabf 0%, #98c0cc 30%, #bcd8c0 70%, #c8e0b4 100%); border: 1px solid rgba(255,255,255,0.5); z-index: 3; min-height: 260px;">
                                <!-- G.H. Stamp -->
                                <div class="absolute -top-4 left-1/2 -translate-x-1/2 w-10 h-10 rounded-full flex items-center justify-center shadow-md" style="background: linear-gradient(135deg, #8b1a1a, #cc2222); border: 2px solid #f5c842; z-index: 10;">
                                    <span class="text-white font-bold" style="font-size: 9px; letter-spacing: 0.05em;">G.H.</span>
                                </div>
                                <!-- Shine overlay -->
                                <div class="absolute inset-0 rounded-lg" style="background: linear-gradient(135deg, rgba(255,255,255,0.25) 0%, transparent 50%); pointer-events: none;"></div>

                                <h3 class="font-bold text-xl mt-3 mb-3" style="color: #1a2e3a; font-family: 'Palatino Linotype', Palatino, serif; line-height: 1.3;">Arcane Resonance Recovery</h3>

                                <p class="text-sm italic mb-4" style="color: #2a3a30; line-height: 1.6; font-family: 'Palatino Linotype', Palatino, serif;">
                                    "Borrow a Stabilizing Staff to collect essence from the Falling Stars crater."
                                </p>

                                <!-- Divider -->
                                <div class="my-3" style="border-top: 1px solid rgba(180,160,100,0.5);"></div>

                                <div class="flex items-center justify-between mt-auto">
                                    <span class="font-bold text-sm" style="color: #c4881a; font-family: 'Palatino Linotype', Palatino, serif;">Reward: Rare Scroll</span>
                                    <div class="flex items-center gap-1 text-xs" style="color: #2a3a30;">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2"/></svg>
                                        <span>5 Days Left</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

               @forelse($activeBorrowings as $borrowing)
    <div class="flex items-center gap-3 p-3 mx-3 mt-2 rounded-lg cursor-pointer hover:opacity-80 transition"
         style="background: rgba(210,185,120,0.5); border: 1px solid rgba(180,150,60,0.4);"
         onclick="showBorrowingModal({{ $borrowing->id }})">

        {{-- Icon --}}
        <div class="w-10 h-10 rounded flex items-center justify-center flex-shrink-0"
             style="background: rgba(180,140,40,0.4);">
            <svg class="w-5 h-5" style="color: #c4a030;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
        </div>

        {{-- Details --}}
        <div class="flex-1 min-w-0">
            <div class="font-bold text-xs mb-0.5 truncate"
                 style="color: #2c1a0e; font-family: 'Palatino Linotype', Palatino, serif;">
                {{ $borrowing->equipment->name }}
            </div>
            <div class="text-xs" style="color: #4a3520;">
                {{ $borrowing->equipment->type ?? 'Equipment' }}
            </div>
        </div>

        {{-- Due date --}}
        <div class="text-right flex-shrink-0">
            <div class="text-xs font-bold uppercase"
                 style="color: {{ $borrowing->isOverdue() ? '#cc2222' : '#cc8822' }}; font-size: 9px; letter-spacing: 0.05em;">
                {{ $borrowing->isOverdue() ? 'OVERDUE' : 'DUE DATE' }}
            </div>
            <div class="font-bold" style="color: {{ $borrowing->isOverdue() ? '#cc2222' : '#cc8822' }}; font-size: 11px;">
                {{ $borrowing->daysLeft() }} {{ Str::plural('Sunset', $borrowing->daysLeft()) }}
            </div>
        </div>
    </div>
@empty
    <div class="p-4 mx-3 text-center text-xs italic" style="color: #8a6a40;">
        No active borrowings...
    </div>
@endforelse
                    </div>
                </div>

            </div>
        </div>

        <!-- Bottom user bar -->
        <div class="fixed bottom-0 left-0 w-64 p-4 flex items-center gap-3" style="background: #3d1a0a; border-top: 1px solid #5a2a10;">
            <div class="w-9 h-9 rounded-full overflow-hidden border-2" style="border-color: #c4a35a;">
                <img src="{{ auth()->user()->profile_photo_url ?? '/images/default-avatar.png' }}" alt="Avatar" class="w-full h-full object-cover">
            </div>
            <div>
                <div class="font-bold text-sm" style="color: #f5e6c8; font-family: 'Palatino Linotype', Palatino, serif;">Grandmaster Kaelen</div>
                <div class="text-xs" style="color: #a08060;">Head Librarian</div>
            </div>
        </div>

    </main>
    {{-- Borrowing Detail Modal --}}
<div id="borrowingModal" class="fixed inset-0 z-50 hidden items-center justify-center"
     style="background: rgba(10,5,2,0.85);"
     onclick="if(event.target===this) closeBorrowingModal()">

    <div class="rounded-2xl shadow-2xl p-6 w-80 relative"
         style="background: linear-gradient(145deg, #2a0d04, #3d1a08); border: 2px solid #c4a35a;">

        <button onclick="closeBorrowingModal()"
                class="absolute top-3 right-4 text-lg font-bold transition hover:opacity-60"
                style="color: #d4a82a;">✕</button>

        <h3 class="font-bold text-lg mb-1" id="modal-item-name"
            style="color: #f5e6b0; font-family: 'Palatino Linotype', Palatino, serif;"></h3>
        <p class="text-xs mb-4" id="modal-item-type" style="color: #c4901a; font-style: italic;"></p>

        <div class="space-y-2 mb-5">
            <div class="flex justify-between text-xs" style="color: #d4b870;">
                <span>Borrowed on</span>
                <span id="modal-borrowed-at" class="font-semibold"></span>
            </div>
            <div class="flex justify-between text-xs" style="color: #d4b870;">
                <span>Due date</span>
                <span id="modal-due-date" class="font-semibold"></span>
            </div>
            <div class="flex justify-between text-xs" style="color: #d4b870;">
                <span>Days remaining</span>
                <span id="modal-days-left" class="font-semibold"></span>
            </div>
        </div>

        <div class="flex gap-3">
            {{-- Return --}}
            <form id="modal-return-form" method="POST" class="flex-1">
                @csrf
                <button type="submit"
                        class="w-full py-2 rounded-lg font-bold text-xs transition hover:opacity-80"
                        style="background: #3d1205; border: 1px solid #c4a35a; color: #f5e6b0; font-family: 'Palatino Linotype', Palatino, serif;">
                    Return Item
                </button>
            </form>

            {{-- Extend --}}
            <form id="modal-extend-form" method="POST" class="flex-1">
                @csrf
                <button type="submit"
                        class="w-full py-2 rounded-lg font-bold text-xs transition hover:opacity-80"
                        style="background: linear-gradient(135deg, #c4901a, #f0c842); color: #2a0d04; font-family: 'Palatino Linotype', Palatino, serif;">
                    +3 Days
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function showBorrowingModal(borrowingId) {
    fetch(`/borrowings/${borrowingId}`)
        .then(r => r.json())
        .then(data => {
            document.getElementById('modal-item-name').textContent  = data.item_name;
            document.getElementById('modal-item-type').textContent  = data.item_type;
            document.getElementById('modal-borrowed-at').textContent = data.borrowed_at;
            document.getElementById('modal-due-date').textContent   = data.due_date;
            document.getElementById('modal-days-left').textContent  =
                data.is_overdue ? 'OVERDUE' : `${data.days_left} days`;

            document.getElementById('modal-return-form').action =
                `/borrowings/${borrowingId}/return`;
            document.getElementById('modal-extend-form').action =
                `/borrowings/${borrowingId}/extend`;

            const modal = document.getElementById('borrowingModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });
}

function closeBorrowingModal() {
    const modal = document.getElementById('borrowingModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>
</x-app-layout>
