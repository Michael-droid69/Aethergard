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

            <!-- MAP SECTION -->
            <div class="relative rounded-2xl overflow-hidden mb-8 shadow-2xl" style="height: 340px; border: 2px solid #c4a35a;">
                <!-- Map background - parchment/world map style -->
                <div class="absolute inset-0" style="background: linear-gradient(135deg, #8b6914 0%, #c4941a 20%, #a07820 40%, #7a5c10 60%, #9c7a1c 80%, #6b4e10 100%);">
                    <!-- Map texture overlay -->
                    <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'400\'%3E%3Cfilter id=\'noise\'%3E%3CfeTurbulence type=\'fractalNoise\' baseFrequency=\'0.9\' numOctaves=\'4\' stitchTiles=\'stitch\'/%3E%3C/filter%3E%3Crect width=\'400\' height=\'400\' filter=\'url(%23noise)\' opacity=\'0.08\'/%3E%3C/svg%3E'); opacity: 0.5;"></div>
                    <!-- Continents SVG approximation -->
                    <svg class="absolute inset-0 w-full h-full" viewBox="0 0 900 340" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
                        <!-- Europe/Africa -->
                        <path d="M380 60 Q400 50 420 55 Q440 60 445 80 Q450 100 440 120 Q430 150 420 180 Q410 210 415 240 Q420 270 410 290 Q400 310 390 295 Q380 280 375 260 Q370 230 365 200 Q360 170 365 140 Q370 100 375 80 Z" fill="#6b4e0a" opacity="0.7"/>
                        <!-- Americas -->
                        <path d="M200 40 Q230 30 250 45 Q270 60 265 90 Q260 120 255 150 Q250 180 240 210 Q230 240 220 260 Q210 280 200 265 Q185 245 180 220 Q175 190 178 160 Q182 130 190 100 Q196 70 200 40 Z" fill="#6b4e0a" opacity="0.6"/>
                        <!-- Asia -->
                        <path d="M500 30 Q560 20 620 35 Q680 50 700 80 Q715 110 700 140 Q685 165 660 175 Q630 185 600 175 Q565 162 540 140 Q515 115 505 90 Q496 60 500 30 Z" fill="#6b4e0a" opacity="0.65"/>
                        <!-- Ley lines - glowing circles -->
                        <circle cx="580" cy="180" r="70" fill="none" stroke="#ffd700" stroke-width="1.5" opacity="0.5"/>
                        <circle cx="580" cy="180" r="110" fill="none" stroke="#ffd700" stroke-width="1" opacity="0.35"/>
                        <circle cx="580" cy="180" r="150" fill="none" stroke="#ffd700" stroke-width="0.8" opacity="0.25"/>
                        <!-- Ley lines radiating -->
                        <line x1="580" y1="180" x2="200" y2="100" stroke="#ffd700" stroke-width="1" opacity="0.3"/>
                        <line x1="580" y1="180" x2="800" y2="60" stroke="#ffd700" stroke-width="1" opacity="0.3"/>
                        <line x1="580" y1="180" x2="750" y2="300" stroke="#ffd700" stroke-width="1" opacity="0.3"/>
                        <line x1="580" y1="180" x2="400" y2="280" stroke="#ffd700" stroke-width="1" opacity="0.3"/>
                        <!-- Red dot marker -->
                        <circle cx="650" cy="175" r="6" fill="#cc2222"/>
                        <circle cx="650" cy="175" r="10" fill="none" stroke="#cc2222" stroke-width="1.5" opacity="0.6"/>
                    </svg>
                </div>

                <!-- Info card overlay (top-left) -->
                <div class="absolute top-5 left-5 rounded-lg p-4 shadow-xl" style="background: rgba(220, 200, 150, 0.88); border: 1px solid #b8963c; max-width: 240px; backdrop-filter: blur(2px);">
                    <h3 class="font-bold text-base mb-1" style="color: #2c1a0e; font-family: 'Palatino Linotype', Palatino, serif;">Aethelgard Ley-Lines</h3>
                    <p class="text-xs italic mb-2" style="color: #4a3520; line-height: 1.5;">
                        Magic flows are heavy near the Whispering Peaks today. Equipment wear may increase by 14%.
                    </p>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4" style="color: #6b8c6b;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/></svg>
                        <span class="text-xs font-semibold" style="color: #2c4a2c;">Mana Density: Optimal</span>
                    </div>
                </div>

                <!-- Expand Chart button -->
                <button class="absolute bottom-4 right-4 flex items-center gap-2 px-4 py-2 rounded text-sm font-bold tracking-wider transition hover:opacity-90" style="background: rgba(30,18,6,0.75); color: #d4a82a; border: 1px solid #c4a35a; font-family: inherit; letter-spacing: 0.1em;">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    EXPAND CHART
                </button>
            </div>

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

                <!-- Active Borrowings (1/3 width) -->
                <div class="col-span-1">
                    <div class="flex items-center gap-2 mb-4">
                        <svg class="w-5 h-5" style="color: #4a3520;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                        <span class="font-bold text-base" style="color: #2c1a0e; font-family: 'Palatino Linotype', Palatino, serif;">Active Borrowings</span>
                    </div>

                    <div class="rounded-xl overflow-hidden shadow-xl" style="background: linear-gradient(160deg, #d4b86a 0%, #c4a84a 30%, #a8d4b8 70%, #90c8a8 100%); border: 2px solid #b89a3a;">

                        <!-- Borrowing Item 1: Sun-Forged Claymore -->
                        <div class="flex items-center gap-3 p-3 mx-3 mt-3 rounded-lg" style="background: rgba(210, 185, 120, 0.5); border: 1px solid rgba(180,150,60,0.4);">
                            <div class="w-10 h-10 rounded flex items-center justify-center flex-shrink-0" style="background: rgba(180,140,40,0.4);">
                                <svg class="w-5 h-5" style="color: #c4a030;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z"/></svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="font-bold text-xs mb-0.5" style="color: #2c1a0e; font-family: 'Palatino Linotype', Palatino, serif;">Sun-Forged Claymore</div>
                                <div class="text-xs" style="color: #4a3520;">
                                    <span>DURABILITY: 88%</span>
                                    <span class="mx-1">·</span>
                                    <span>ENCHANTMENT: GRADE II</span>
                                </div>
                            </div>
                            <div class="text-right flex-shrink-0">
                                <div class="text-xs font-bold uppercase" style="color: #cc2222; font-size: 9px; letter-spacing: 0.05em;">DUE DATE</div>
                                <div class="font-bold" style="color: #cc2222; font-size: 11px;">3 Sunsets</div>
                            </div>
                        </div>

                        <!-- Borrowing Item 2: Griffin-Scale Mail -->
                        <div class="flex items-center gap-3 p-3 mx-3 mt-2 rounded-lg" style="background: rgba(210, 185, 120, 0.5); border: 1px solid rgba(180,150,60,0.4);">
                            <div class="w-10 h-10 rounded flex items-center justify-center flex-shrink-0" style="background: rgba(180,140,40,0.4);">
                                <svg class="w-5 h-5" style="color: #c4a030;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="font-bold text-xs mb-0.5" style="color: #2c1a0e; font-family: 'Palatino Linotype', Palatino, serif;">Griffin-Scale Mail</div>
                                <div class="text-xs" style="color: #4a3520;">
                                    <span>DURABILITY: 62%</span>
                                    <span class="mx-1">·</span>
                                    <span>RESIST: FIRE/FROST</span>
                                </div>
                            </div>
                            <div class="text-right flex-shrink-0">
                                <div class="text-xs font-bold uppercase" style="color: #cc2222; font-size: 9px; letter-spacing: 0.05em;">DUE DATE</div>
                                <div class="font-bold" style="color: #cc2222; font-size: 11px;">1 Sunset</div>
                            </div>
                        </div>

                        <!-- Footer: REQUEST EXTENSION + plus button -->
                        <div class="flex items-center mt-3" style="border-top: 1px solid rgba(180,150,60,0.3);">
                            <button class="flex-1 py-3 font-bold text-sm tracking-widest transition hover:opacity-80" style="color: #2c1a0e; font-family: 'Palatino Linotype', Palatino, serif; letter-spacing: 0.15em; background: transparent;">
                                REQUEST EXTENSION
                            </button>
                            <button class="w-12 h-12 flex items-center justify-center text-xl font-bold rounded-br-xl transition hover:opacity-80" style="background: #2c1a0e; color: #d4a82a;">
                                +
                            </button>
                        </div>

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
</x-app-layout>
