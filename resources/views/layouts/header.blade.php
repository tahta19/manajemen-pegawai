<header class="bg-white border-bottom p-3 d-flex justify-content-between align-items-center sticky-top" style="z-index: 1000;">
    <div class="d-flex align-items-center">
        <!-- Tombol Toggle Sidebar -->
        <button class="btn btn-light border me-3" type="button" id="toggleSidebar">
            <i class="bi bi-list fs-5"></i>
        </button>

        <div>
            <h5 class="mb-0 fw-bold">@yield('page_title', 'Dashboard Eksekutif')</h5>
            <small class="text-muted d-none d-md-block">Sistem Informasi Kepegawaian</small>
        </div>
    </div>
    
    <div class="d-flex gap-2 align-items-center">
        <button class="btn btn-light btn-sm border d-none d-md-block">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</button>
        <button class="btn btn-light btn-sm border">Admin Panel</button>
    </div>
</header>