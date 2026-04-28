{{--
╔══════════════════════════════════════════════════════════════════╗
║              GUILD HALL MAP SECTION — SETUP GUIDE               ║
╠══════════════════════════════════════════════════════════════════╣
║                                                                  ║
║  1. FOLDER SETUP                                                 ║
║     Create this folder in your Laravel project:                  ║
║       public/maps/                                               ║
║     Put your Azgaar SVG files there:                             ║
║       public/maps/drutsia.svg        ← world map                ║
║       public/maps/region-north.svg   ← region maps              ║
║       public/maps/region-south.svg                               ║
║       public/maps/region-east.svg                                ║
║                                                                  ║
║  2. TO ADD A NEW REGION MAP                                      ║
║     Export SVG from Azgaar → save to public/maps/               ║
║     Then find the $regions array below and add one line:         ║
║       ['id' => 'myregion', 'label' => 'My Region Name',         ║
║        'file' => 'my-region.svg',                                ║
║        'marker' => ['x' => '45%', 'y' => '30%']],               ║
║     That's it. The dropdown, button, and embed all update auto.  ║
║                                                                  ║
║  3. MARKER POSITIONS (x/y)                                       ║
║     These are % positions of the red dot on the WORLD map        ║
║     that shows where that region is located.                     ║
║     Tweak until the dot lands on the right spot visually.        ║
║                                                                  ║
╚══════════════════════════════════════════════════════════════════╝
--}}

@php
    /**
     * ─────────────────────────────────────────────
     *  ADD / EDIT REGIONS HERE
     *  Each entry needs:
     *    id     → unique slug (used in JS, no spaces)
     *    label  → display name in dropdown & tooltip
     *    file   → filename inside public/maps/
     *    marker → x/y % position of dot on world map
     * ─────────────────────────────────────────────
     */
    $regions = [
        [
            'id'     => 'world',
            'label'  => 'Drutsia — World Map',
            'file'   => 'drutsia.svg',   // ← your uploaded file renamed
            'marker' => null,            // world map has no dot
        ],
        // --- ADD MORE REGIONS BELOW THIS LINE ---
         [
             'id'     => 'north',
             'label'  => 'Borte',
             'file'   => 'Borte.svg',
             'marker' => null, // region maps don't need markers
         ],
         [
             'id'     => 'capital',
             'label'  => 'Oslob',
             'file'   => 'Oslob.svg',
             'marker' => null,
         ],
         [
             'id'     => 'south',
             'label'  => 'Saint Germain',
             'file'   => 'Saint.svg',
             'marker' => null,
         ],
          [
             'id'     => 'west',
             'label'  => 'Saint Laurent',
             'file'   => 'laur.svg',
             'marker' => null,
         ],
    ];

    $activeRegion = $regions[0]; // default to world map
@endphp

<style>
    /* ── Map container ── */
    .map-wrapper {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        border: 2px solid #c4a35a;
        box-shadow: 0 8px 32px rgba(0,0,0,0.4), 0 0 0 1px rgba(196,163,90,0.3);
        height: 380px;
        margin-bottom: 2rem;
        background: #1a1008;
    }

    /* ── Pannable / zoomable viewport ── */
    #map-viewport {
        width: 100%;
        height: 100%;
        overflow: hidden;
        cursor: grab;
        position: relative;
    }
    #map-viewport:active { cursor: grabbing; }

    #map-inner {
        width: 100%;
        height: 100%;
        transform-origin: 0 0;
        transition: transform 0.08s linear;
        will-change: transform;
    }

    /* The SVG / img fills the inner container */
    #map-inner img,
    #map-inner object,
    #map-inner svg {
        width: 100%;
        height: 100%;
        display: block;
    }

    /* ── Info card overlay ── */
    .map-info-card {
        position: absolute;
        top: 14px;
        left: 14px;
        background: rgba(220, 200, 150, 0.9);
        border: 1px solid #b8963c;
        border-radius: 10px;
        padding: 12px 16px;
        max-width: 230px;
        backdrop-filter: blur(4px);
        pointer-events: none;
        z-index: 20;
    }

    /* ── Zoom controls ── */
    .map-zoom-controls {
        position: absolute;
        bottom: 48px;
        right: 14px;
        display: flex;
        flex-direction: column;
        gap: 4px;
        z-index: 20;
    }
    .zoom-btn {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        border: 1px solid #c4a35a;
        background: rgba(20, 10, 3, 0.8);
        color: #d4a82a;
        font-size: 18px;
        font-weight: bold;
        line-height: 1;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.15s, transform 0.1s;
        backdrop-filter: blur(4px);
    }
    .zoom-btn:hover { background: rgba(196,163,90,0.25); }
    .zoom-btn:active { transform: scale(0.92); }

    /* Reset zoom button */
    .zoom-reset {
        font-size: 11px;
        letter-spacing: 0.05em;
        font-weight: 600;
        font-family: 'Palatino Linotype', Palatino, serif;
    }

    /* ── Region dropdown ── */
    .region-dropdown-wrapper {
        position: absolute;
        top: 14px;
        right: 14px;
        z-index: 20;
    }
    .region-select-btn {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 7px 12px;
        background: rgba(20,10,3,0.82);
        border: 1px solid #c4a35a;
        border-radius: 8px;
        color: #d4a82a;
        font-size: 12px;
        font-weight: bold;
        font-family: 'Palatino Linotype', Palatino, serif;
        letter-spacing: 0.08em;
        cursor: pointer;
        backdrop-filter: blur(4px);
        transition: background 0.15s;
    }
    .region-select-btn:hover { background: rgba(196,163,90,0.2); }

    .region-dropdown-menu {
        display: none;
        position: absolute;
        top: calc(100% + 6px);
        right: 0;
        min-width: 200px;
        background: rgba(20,10,3,0.95);
        border: 1px solid #c4a35a;
        border-radius: 10px;
        overflow: hidden;
        backdrop-filter: blur(8px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.5);
    }
    .region-dropdown-menu.open { display: block; }

    .region-option {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        color: #d4a82a;
        font-size: 13px;
        font-family: 'Palatino Linotype', Palatino, serif;
        cursor: pointer;
        transition: background 0.15s;
        border: none;
        background: none;
        width: 100%;
        text-align: left;
    }
    .region-option:hover { background: rgba(196,163,90,0.15); color: #f5e090; }
    .region-option.active { background: rgba(196,163,90,0.25); color: #f5d060; font-weight: bold; }
    .region-option + .region-option { border-top: 1px solid rgba(196,163,90,0.15); }

    /* ── Region markers on world map ── */
    .region-marker {
        position: absolute;
        transform: translate(-50%, -50%);
        z-index: 15;
        cursor: pointer;
    }
    .region-marker-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #cc2222;
        border: 2px solid #ff6644;
        box-shadow: 0 0 8px rgba(204,34,34,0.8), 0 0 16px rgba(204,34,34,0.4);
        animation: pulse-marker 2s infinite;
        transition: transform 0.15s;
    }
    .region-marker:hover .region-marker-dot {
        transform: scale(1.4);
    }
    .region-marker-label {
        position: absolute;
        top: 16px;
        left: 50%;
        transform: translateX(-50%);
        white-space: nowrap;
        background: rgba(20,10,3,0.85);
        color: #f0c842;
        font-size: 10px;
        font-family: 'Palatino Linotype', Palatino, serif;
        padding: 2px 6px;
        border-radius: 4px;
        border: 1px solid rgba(196,163,90,0.4);
        pointer-events: none;
        opacity: 0;
        transition: opacity 0.15s;
    }
    .region-marker:hover .region-marker-label { opacity: 1; }

    @keyframes pulse-marker {
        0%, 100% { box-shadow: 0 0 8px rgba(204,34,34,0.8), 0 0 16px rgba(204,34,34,0.4); }
        50%       { box-shadow: 0 0 14px rgba(204,34,34,1),   0 0 28px rgba(204,34,34,0.6); }
    }

    /* ── Expand button ── */
    .map-expand-btn {
        position: absolute;
        bottom: 14px;
        right: 14px;
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 8px 14px;
        background: rgba(30,18,6,0.78);
        color: #d4a82a;
        border: 1px solid #c4a35a;
        border-radius: 6px;
        font-size: 11px;
        font-weight: bold;
        font-family: 'Palatino Linotype', Palatino, serif;
        letter-spacing: 0.1em;
        cursor: pointer;
        backdrop-filter: blur(4px);
        transition: background 0.15s;
        z-index: 20;
    }
    .map-expand-btn:hover { background: rgba(196,163,90,0.2); }

    /* ── Loading state ── */
    .map-loading {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(20,10,3,0.7);
        color: #d4a82a;
        font-family: 'Palatino Linotype', Palatino, serif;
        font-size: 14px;
        letter-spacing: 0.1em;
        z-index: 30;
        pointer-events: none;
        opacity: 0;
        transition: opacity 0.2s;
    }
    .map-loading.visible { opacity: 1; }

    /* ── Fullscreen modal ── */
    .map-modal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(10,5,2,0.92);
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }
    .map-modal.open { display: flex; }
    .map-modal-inner {
        position: relative;
        width: 95vw;
        height: 90vh;
        border: 2px solid #c4a35a;
        border-radius: 16px;
        overflow: hidden;
        background: #1a1008;
    }
    .map-modal-close {
        position: absolute;
        top: 12px;
        right: 12px;
        z-index: 10;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: rgba(20,10,3,0.9);
        border: 1px solid #c4a35a;
        color: #d4a82a;
        font-size: 18px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

<!-- ═══════════════════ MAP SECTION ═══════════════════ -->
<div class="map-wrapper" id="mapSection">

    <!-- Loading overlay -->
    <div class="map-loading" id="mapLoading">Loading map...</div>

    <!-- Pannable / Zoomable viewport -->
    <div id="map-viewport">
        <div id="map-inner">
            {{--
                The SVG is loaded via <img> tag pointing to public/maps/
                When you want to switch maps (regions), JS swaps the src.
                Using <img> keeps it simple and avoids CORS issues.
            --}}
            <img id="mapImage"
                 src="{{ asset('maps/drutsia.svg') }}"
                 alt="Aethelgard World Map"
                 style="min-width: 100%; min-height: 100%; object-fit: cover; display: block;"
                 draggable="false">
        </div>
    </div>

    <!-- Region markers (only shown on world map) -->
    <div id="regionMarkers">
        @foreach($regions as $region)
            @if($region['marker'])
                <div class="region-marker"
                     style="left: {{ $region['marker']['x'] }}; top: {{ $region['marker']['y'] }};"
                     onclick="loadRegion('{{ $region['id'] }}')"
                     title="{{ $region['label'] }}">
                    <div class="region-marker-dot"></div>
                    <div class="region-marker-label">{{ $region['label'] }}</div>
                </div>
            @endif
        @endforeach
    </div>

    <!-- Info card (top-left) -->
    <div class="map-info-card">
        <h3 style="font-weight: 700; font-size: 14px; margin-bottom: 4px; color: #2c1a0e; font-family: 'Palatino Linotype', Palatino, serif;" id="mapInfoTitle">
            Aethelgard Ley-Lines
        </h3>
        <p style="font-size: 11px; font-style: italic; color: #4a3520; line-height: 1.5; margin-bottom: 6px;" id="mapInfoDesc">
            Magic flows are heavy near the Whispering Peaks today. Equipment wear may increase by 14%.
        </p>
        <div style="display: flex; align-items: center; gap: 6px;">
            <svg width="14" height="14" fill="none" stroke="#6b8c6b" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/></svg>
            <span style="font-size: 11px; font-weight: 600; color: #2c4a2c;">Mana Density: Optimal</span>
        </div>
    </div>

    <!-- Region dropdown (top-right) -->
    <div class="region-dropdown-wrapper">
        <button class="region-select-btn" onclick="toggleRegionDropdown()" id="regionDropdownBtn">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
            </svg>
            <span id="regionBtnLabel">World Map</span>
            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
        </button>

        <div class="region-dropdown-menu" id="regionDropdownMenu">
            @foreach($regions as $index => $region)
                <button class="region-option {{ $index === 0 ? 'active' : '' }}"
                        id="region-opt-{{ $region['id'] }}"
                        onclick="loadRegion('{{ $region['id'] }}')">
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    {{ $region['label'] }}
                </button>
            @endforeach
        </div>
    </div>

    <!-- Zoom controls -->
    <div class="map-zoom-controls">
        <button class="zoom-btn" onclick="zoomMap(0.2)" title="Zoom in">+</button>
        <button class="zoom-btn zoom-reset" onclick="resetMapZoom()" title="Reset view">⌂</button>
        <button class="zoom-btn" onclick="zoomMap(-0.2)" title="Zoom out">−</button>
    </div>

    <!-- Expand button -->
    <button class="map-expand-btn" onclick="openMapModal()">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
        EXPAND CHART
    </button>
</div>

<!-- ═══════════════════ FULLSCREEN MODAL ═══════════════════ -->
<div class="map-modal" id="mapModal" onclick="closeMapModal(event)">
    <div class="map-modal-inner">
        <button class="map-modal-close" onclick="closeMapModal()">✕</button>
        <div id="map-viewport-modal" style="width:100%;height:100%;overflow:hidden;cursor:grab;">
            <div id="map-inner-modal" style="width:100%;height:100%;transform-origin:0 0;will-change:transform;">
                <img id="mapImageModal"
                     src="{{ asset('maps/drutsia.svg') }}"
                     alt="Map fullscreen"
                     style="min-width:100%;min-height:100%;object-fit:cover;display:block;"
                     draggable="false">
            </div>
        </div>
    </div>
</div>

<script>
// ══════════════════════════════════════════════
//  REGION DATA (mirrors PHP $regions above)
//  When you add a region in PHP, add the same
//  entry here so JS knows the file path.
// ══════════════════════════════════════════════
const REGIONS = @json($regions);

// Current active region id
let activeRegionId = 'world';

// ── Region switching ──────────────────────────
function loadRegion(id) {
    const region = REGIONS.find(r => r.id === id);
    if (!region) return;

    activeRegionId = id;

    // Show loading
    const loader = document.getElementById('mapLoading');
    loader.classList.add('visible');

    // Swap image
    const img    = document.getElementById('mapImage');
    const imgUrl = `/maps/${region.file}`;
    img.src = imgUrl;
    img.onload = () => {
        loader.classList.remove('visible');
        resetMapZoom();
    };

    // Sync modal image too
    document.getElementById('mapImageModal').src = imgUrl;

    // Update info card title
    document.getElementById('mapInfoTitle').textContent = region.label;
    document.getElementById('mapInfoDesc').textContent =
        id === 'world'
            ? 'Magic flows are heavy near the Whispering Peaks today. Equipment wear may increase by 14%.'
            : `Viewing detailed region: ${region.label}`;

    // Update dropdown button label
    document.getElementById('regionBtnLabel').textContent = region.label;

    // Update dropdown active state
    REGIONS.forEach(r => {
        const opt = document.getElementById('region-opt-' + r.id);
        if (opt) opt.classList.toggle('active', r.id === id);
    });

    // Show/hide markers (only on world map)
    document.getElementById('regionMarkers').style.display =
        id === 'world' ? 'block' : 'none';

    closeRegionDropdown();
}

// ── Dropdown toggle ───────────────────────────
function toggleRegionDropdown() {
    document.getElementById('regionDropdownMenu').classList.toggle('open');
}
function closeRegionDropdown() {
    document.getElementById('regionDropdownMenu').classList.remove('open');
}
// Close dropdown on outside click
document.addEventListener('click', (e) => {
    if (!e.target.closest('.region-dropdown-wrapper')) closeRegionDropdown();
});

// ══════════════════════════════════════════════
//  PAN + ZOOM (shared logic for both viewports)
// ══════════════════════════════════════════════
function makeZoomPan(viewportId, innerId) {
    const viewport = document.getElementById(viewportId);
    const inner    = document.getElementById(innerId);
    if (!viewport || !inner) return;

    let scale = 1, tx = 0, ty = 0;
    let dragging = false, startX, startY, startTx, startTy;

    function apply() {
        inner.style.transform = `translate(${tx}px, ${ty}px) scale(${scale})`;
    }

    function clamp() {
        const vw = viewport.clientWidth, vh = viewport.clientHeight;
        const maxTx = 0, minTx = vw - vw * scale;
        const maxTy = 0, minTy = vh - vh * scale;
        tx = Math.min(maxTx, Math.max(minTx, tx));
        ty = Math.min(maxTy, Math.max(minTy, ty));
    }

    // Mouse drag
    viewport.addEventListener('mousedown', e => {
        dragging = true; startX = e.clientX; startY = e.clientY;
        startTx = tx; startTy = ty;
    });
    window.addEventListener('mousemove', e => {
        if (!dragging) return;
        tx = startTx + (e.clientX - startX);
        ty = startTy + (e.clientY - startY);
        clamp(); apply();
    });
    window.addEventListener('mouseup', () => dragging = false);

    // Touch drag
    viewport.addEventListener('touchstart', e => {
        if (e.touches.length === 1) {
            dragging = true;
            startX = e.touches[0].clientX; startY = e.touches[0].clientY;
            startTx = tx; startTy = ty;
        }
    }, { passive: true });
    viewport.addEventListener('touchmove', e => {
        if (!dragging || e.touches.length !== 1) return;
        tx = startTx + (e.touches[0].clientX - startX);
        ty = startTy + (e.touches[0].clientY - startY);
        clamp(); apply();
        e.preventDefault();
    }, { passive: false });
    viewport.addEventListener('touchend', () => dragging = false);

    // Scroll to zoom
    viewport.addEventListener('wheel', e => {
        e.preventDefault();
        const rect   = viewport.getBoundingClientRect();
        const mouseX = e.clientX - rect.left;
        const mouseY = e.clientY - rect.top;
        const delta  = e.deltaY > 0 ? -0.12 : 0.12;
        const newScale = Math.min(6, Math.max(0.4, scale + delta));
        // Zoom toward mouse position
        tx = mouseX - (mouseX - tx) * (newScale / scale);
        ty = mouseY - (mouseY - ty) * (newScale / scale);
        scale = newScale;
        clamp(); apply();
    }, { passive: false });

    return {
        zoomBy(delta) {
            const vw = viewport.clientWidth, vh = viewport.clientHeight;
            const cx = vw / 2, cy = vh / 2;
            const newScale = Math.min(6, Math.max(0.4, scale + delta));
            tx = cx - (cx - tx) * (newScale / scale);
            ty = cy - (cy - ty) * (newScale / scale);
            scale = newScale;
            clamp(); apply();
        },
        reset() {
            scale = 1; tx = 0; ty = 0; apply();
        }
    };
}

// Init both viewports
const mainMap  = makeZoomPan('map-viewport',       'map-inner');
const modalMap = makeZoomPan('map-viewport-modal', 'map-inner-modal');

// Expose for buttons
function zoomMap(delta)  { mainMap.zoomBy(delta); }
function resetMapZoom()  { mainMap.reset(); }

// ── Fullscreen modal ──────────────────────────
function openMapModal() {
    document.getElementById('mapModal').classList.add('open');
    modalMap.reset();
}
function closeMapModal(e) {
    if (!e || e.target === document.getElementById('mapModal') || !e.target.closest) {
        document.getElementById('mapModal').classList.remove('open');
    }
}
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeMapModal();
});
</script>
