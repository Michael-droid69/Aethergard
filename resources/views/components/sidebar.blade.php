<div>
<style>
    /* Active nav item - extends to right edge like a book page tab */
    .nav-item {
        position: relative;
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        border-radius: 10px 0 0 10px;
        transition: background 0.35s cubic-bezier(0.4, 0, 0.2, 1),
                    color 0.2s ease,
                    transform 0.2s cubic-bezier(0.34, 1.56, 0.64, 1),
                    box-shadow 0.3s ease;
        text-decoration: none;
        margin-right: -3px; /* bleeds into the gold border */
        overflow: visible;
    }
 
    .nav-item:hover:not(.nav-active) {
        background: rgba(255, 255, 255, 0.07);
    }
 
    /* Active state - parchment tab that bleeds to right edge */
    .nav-active {
        background: linear-gradient(90deg, #f5ecc8 0%, #ede0a8 60%, #e8d890 100%) !important;
        box-shadow:
            0 0 12px rgba(240, 200, 66, 0.35),
            0 0 24px rgba(240, 200, 66, 0.15),
            inset 0 1px 0 rgba(255,255,255,0.6),
            inset 0 -1px 0 rgba(180,140,30,0.3);
        transform: scaleX(1.03);
        transform-origin: left center;
        border-right: none;
        /* Slight glow on left edge */
        border-left: 2px solid rgba(240, 200, 66, 0.6);
    }
 
    .nav-active::after {
        content: '';
        position: absolute;
        right: -3px;
        top: 0;
        bottom: 0;
        width: 4px;
        background: linear-gradient(180deg, #f0c842, #c4901a);
        border-radius: 0;
    }
 
    /* Top and bottom notch cutout effect on active tab */
    .nav-active::before {
        content: '';
        position: absolute;
        right: -3px;
        top: -8px;
        width: 10px;
        height: 10px;
        border-radius: 0 0 8px 0;
        background: transparent;
        box-shadow: 3px 3px 0 0 #c4a035;
        pointer-events: none;
    }
 
    /* Tap/click animation */
    .nav-item:active {
        transform: scale(0.97);
        transition: transform 0.1s ease;
    }
 
    .nav-active:active {
        transform: scaleX(1.03) scale(0.98);
    }
 
    /* Icon color transitions */
    .nav-icon {
        transition: color 0.25s ease, filter 0.25s ease;
        flex-shrink: 0;
        width: 20px;
        height: 20px;
    }
 
    .nav-active .nav-icon {
        color: #2a0d04 !important;
        filter: drop-shadow(0 0 3px rgba(200, 140, 20, 0.4));
    }
 
    .nav-item:not(.nav-active) .nav-icon {
        color: #c4901a;
    }
 
    /* Label transitions */
    .nav-label {
        font-family: 'Palatino Linotype', Palatino, serif;
        font-size: 0.875rem;
        font-weight: 600;
        transition: color 0.25s ease, font-weight 0.1s ease;
    }
 
    .nav-active .nav-label {
        color: #2a0d04;
        font-weight: 700;
    }
 
    .nav-item:not(.nav-active) .nav-label {
        color: #d4a840;
    }
 
    .nav-item:not(.nav-active):hover .nav-label {
        color: #f5e090;
    }
 
    .nav-item:not(.nav-active):hover .nav-icon {
        color: #f0c842 !important;
    }
 
    /* Sliding indicator bar on the left */
    .nav-active-bar {
        position: absolute;
        left: 0;
        top: 4px;
        bottom: 4px;
        width: 3px;
        border-radius: 0 2px 2px 0;
        background: linear-gradient(180deg, #f0c842, #c4901a);
        box-shadow: 0 0 6px rgba(240, 200, 66, 0.8);
    }
</style>
 
<aside class="fixed top-0 left-0 h-screen w-64 flex flex-col font-serif"
       style="background: linear-gradient(180deg, #3d1205 0%, #2a0d04 40%, #1e0a03 100%); border-right: 3px solid #c4a035; overflow: visible;">
 
    <!-- Logo + Title -->
    <div class="flex flex-col items-center pt-8 pb-6 px-4">
        <div class="w-16 h-16 rounded-2xl flex items-center justify-center mb-4 shadow-lg"
             style="background: linear-gradient(145deg, #f0c842, #c4901a); border: 2px solid #f5d060;">
            <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="4" y="14" width="28" height="18" rx="1" fill="#2a0d04" stroke="#2a0d04" stroke-width="0.5"/>
                <rect x="4" y="18" width="28" height="14" rx="1" fill="#2a0d04"/>
                <rect x="4" y="12" width="5" height="6" rx="0.5" fill="#2a0d04"/>
                <rect x="11" y="12" width="5" height="6" rx="0.5" fill="#2a0d04"/>
                <rect x="20" y="12" width="5" height="6" rx="0.5" fill="#2a0d04"/>
                <rect x="27" y="12" width="5" height="6" rx="0.5" fill="#2a0d04"/>
                <path d="M14 32 L14 24 Q18 20 22 24 L22 32 Z" fill="#f0c842"/>
                <rect x="7" y="20" width="5" height="5" rx="0.5" fill="#f0c842"/>
                <rect x="24" y="20" width="5" height="5" rx="0.5" fill="#f0c842"/>
            </svg>
        </div>
        <div class="text-center">
            <h1 class="font-extrabold tracking-widest text-lg"
                style="color: #f5e6b0; letter-spacing: 0.2em; font-family: 'Palatino Linotype', Palatino, serif;">GUILD HALL</h1>
            <p class="text-xs tracking-widest mt-0.5"
               style="color: #c4901a; letter-spacing: 0.25em; font-style: italic;">ROYAL ARCHIVE</p>
        </div>
    </div>
 
    <!-- Divider -->
    <div class="mx-4 mb-2" style="height: 1px; background: linear-gradient(90deg, transparent, #c4a035, transparent);"></div>
 
    <!-- Navigation -->
    <nav class="flex-1 px-3 pt-3 space-y-1" style="overflow: visible;">
 
        <!-- Home -->
        <a href="{{ url('/home') }}"
           class="nav-item {{ request()->is('home') ? 'nav-active' : '' }}">
            @if(request()->is('home'))
                <span class="nav-active-bar"></span>
            @endif
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            <span class="nav-label">Home</span>
        </a>
 
        <!-- Blades -->
        <a href="{{ url('/equipment/Blades') }}"
           class="nav-item {{ request()->is('equipment/Blades') ? 'nav-active' : '' }}">
            @if(request()->is('equipment/Blades'))
                <span class="nav-active-bar"></span>
            @endif
            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14.5 17.5L3 6V3h3l11.5 11.5"/>
                <path d="M13 19l6-6"/>
                <path d="M16 16l4 4"/>
                <path d="M19 21l2-2"/>
                <path d="M14.5 6.5L18 3h3v3l-3.5 3.5"/>
                <path d="M5 14l5 5"/>
                <path d="M3 19l2-2"/>
            </svg>
            <span class="nav-label">Blades</span>
        </a>
 
        <!-- Grimoire -->
        <a href="{{ url('/equipment/Books') }}"
           class="nav-item {{ request()->is('equipment/Books') ? 'nav-active' : '' }}">
            @if(request()->is('equipment/Books'))
                <span class="nav-active-bar"></span>
            @endif
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
            <span class="nav-label">Grimoire</span>
        </a>
 
        <!-- Staff -->
        <a href="{{ url('/equipment/Magic Staffs') }}"
           class="nav-item {{ request()->is('equipment/Magic*') ? 'nav-active' : '' }}">
            @if(request()->is('equipment/Magic*'))
                <span class="nav-active-bar"></span>
            @endif
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 3l1.5 4.5L18 9l-4.5 1.5L12 15l-1.5-4.5L6 9l4.5-1.5L12 3z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M19 13l0.75 2.25L22 16l-2.25.75L19 19l-.75-2.25L16 16l2.25-.75L19 13z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M5 17l.5 1.5L7 19l-1.5.5L5 21l-.5-1.5L3 19l1.5-.5L5 17z"/>
            </svg>
            <span class="nav-label">Staff</span>
        </a>
 
        <!-- Armor -->
        <a href="{{ url('/equipment/Armors') }}"
           class="nav-item {{ request()->is('equipment/Armors') ? 'nav-active' : '' }}">
            @if(request()->is('equipment/Armors'))
                <span class="nav-active-bar"></span>
            @endif
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
            <span class="nav-label">Armor</span>
        </a>
 
        <!-- Companion -->
        <a href="{{ url('/companions') }}"
           class="nav-item {{ request()->is('companions') ? 'nav-active' : '' }}">
            @if(request()->is('companions'))
                <span class="nav-active-bar"></span>
            @endif
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M14 10h.01M10 10h.01M7 15c0 2.761 2.239 5 5 5s5-2.239 5-5c0-.828-.224-1.607-.617-2.277"/>
                <circle cx="7.5" cy="8.5" r="1.5" stroke-width="2"/>
                <circle cx="16.5" cy="8.5" r="1.5" stroke-width="2"/>
                <circle cx="5" cy="12" r="1.5" stroke-width="2"/>
                <circle cx="19" cy="12" r="1.5" stroke-width="2"/>
            </svg>
            <span class="nav-label">Companion</span>
        </a>
 
    </nav>
 
    <!-- Bottom divider -->
    <div class="mx-4 mt-2" style="height: 1px; background: linear-gradient(90deg, transparent, #c4a035, transparent);"></div>
 
    <!-- Right gold accent border glow -->
    <div class="absolute top-0 right-0 h-full w-0.5"
         style="background: linear-gradient(180deg, transparent 0%, #c4a035 20%, #f0c842 50%, #c4a035 80%, transparent 100%);"></div>
 
</aside>
</div>