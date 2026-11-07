<div class="sidebar p-3 d-flex flex-column" id="sidebar" style="width: 260px; min-height: 100vh; background-color: #1a1e29; color: #fff;">
    
    <!-- Logo SISKA  -->
    <div class="d-flex align-items-center mb-4 px-2 pt-2">
        <div class="bg-primary text-white rounded d-flex justify-content-center align-items-center me-2" style="width: 32px; height: 32px;">
            <i class="bi bi-box-seam fw-bold"></i>
        </div>
        <h5 class="mb-0 fw-bold text-white tracking-wide">SISKA</h5>
    </div>
    
    <!-- Menu Utama -->
    <div class="mb-2 mt-2 text-uppercase text-secondary px-2" style="font-size: 0.7rem; letter-spacing: 1px;">Menu Utama</div>
    
    <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <i class="bi bi-grid-1x2-fill me-3"></i> Dashboard
    </a>
    <a href="{{ route('pegawai.index') }}" class="sidebar-link {{ request()->routeIs('pegawai.*') ? 'active' : '' }}">
        <i class="bi bi-people-fill me-3"></i> Data Pegawai
    </a>

    <!-- Spacer untuk mendorong user info ke bawah -->
    <div class="mt-auto pt-5">
        <a href="#" class="d-flex align-items-center text-decoration-none p-2 rounded" style="background-color: rgba(255,255,255,0.05); transition: 0.2s;" onmouseover="this.style.backgroundColor='rgba(255,255,255,0.1)'" onmouseout="this.style.backgroundColor='rgba(255,255,255,0.05)'">
            <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center me-3 fw-bold" style="width: 40px; height: 40px;">
                AD
            </div>
            <div>
                <div class="fw-bold text-white" style="font-size: 0.9rem;">Administrator</div>
                <div class="text-secondary" style="font-size: 0.75rem;">admin@instansi.go.id</div>
            </div>
        </a>
    </div>
</div>