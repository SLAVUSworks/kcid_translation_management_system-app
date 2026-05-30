<aside id="sidebar" role="navigation" aria-label="Sidebar navigation">

    <div class="sidebar-logo">
        <h1>_ignore-_furniture-descs.json</h1>
        <p>KCID_TMS-APP</p>
    </div>

    <nav class="sidebar-nav">
        <a
            href="{{ route('furniture-descs.index') }}"
            class="sidebar-link {{ request()->routeIs('furniture-descs.index') ? 'active' : '' }}"
        >
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
            </svg>
            List All
        </a>

        <a
            href="{{ route('furniture-descs.import.form') }}"
            class="sidebar-link {{ request()->routeIs('furniture-descs.import*') ? 'active' : '' }}"
        >
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                <polyline points="17 8 12 3 7 8"/>
                <line x1="12" y1="3" x2="12" y2="15"/>
            </svg>
            Import JSON
        </a>

        <a
            href="{{ route('furniture-descs.create') }}"
            class="sidebar-link {{ request()->routeIs('furniture-descs.create') ? 'active' : '' }}"
        >
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="16"/>
                <line x1="8" y1="12" x2="16" y2="12"/>
            </svg>
            Create New
        </a>

        <div style="height:1px; background:#1e2436; margin: 0.5rem 0;"></div>

        <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14"/>
            </svg>
            Dashboard
        </a>
    </nav>

</aside>