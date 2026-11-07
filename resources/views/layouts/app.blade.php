<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISKA - @yield('title', 'Sistem Manajemen Pegawai')</title>
    
    <!-- Bootstrap v5.3.3 & Ikon -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2"></script>
    
    <style>
        body { background-color: #f8f9fa; overflow: hidden; /* Mencegah double scrollbar di body */ }
        
        /* --- LAYOUT UTAMA --- */
        .app-wrapper {
            display: flex;
            height: 100vh; /* Memaksa tinggi penuh satu layar */
            width: 100vw;
        }

        /* --- SIDEBAR --- */
        #sidebar-wrapper {
            width: 260px;
            min-width: 260px;
            height: 100vh;
            background-color: #1a1e29;
            transition: margin-left 0.3s ease-in-out;
            z-index: 1040;
        }

        /* Saat sidebar ditutup, geser ke kiri */
        #sidebar-wrapper.closed {
            margin-left: -260px; 
        }

        /* --- AREA KONTEN KANAN (Bisa di-scroll sendiri) --- */
        #page-content-wrapper {
            flex-grow: 1;
            height: 100vh;
            overflow-y: auto; /* Scrollbar hanya muncul di area ini */
            display: flex;
            flex-direction: column;
        }

        /* --- STYLING MENU SIDEBAR --- */
        .sidebar-link { 
            color: #a1a5b7; 
            text-decoration: none; 
            display: flex; 
            align-items: center;
            padding: 12px 15px; 
            border-radius: 8px; 
            margin-bottom: 5px; 
            font-weight: 500;
            transition: all 0.2s ease-in-out; 
        }
        .sidebar-link i { font-size: 1.1rem; }
        .sidebar-link:hover { background-color: rgba(37, 99, 235, 0.15); color: #3b82f6; transform: translateX(4px); }
        .sidebar-link.active { background-color: #2563eb; color: #fff; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3); }
        
        .card { border-radius: 12px; border: none; }

        /* --- STYLING FORM & DROPDOWN (KONTRAS) --- */
        .form-control:focus, .form-select:focus {
            background-color: #fff !important; /* Ubah background jadi putih bersih saat diklik */
            border-color: #3b82f6 !important; /* Border biru tegas */
            box-shadow: 0 0 0 0.25rem rgba(59, 130, 246, 0.25) !important; /* Efek glow biru */
            transform: translateY(-1px); /* Efek sedikit terangkat */
            transition: all 0.2s ease-in-out;
        }

        /* Styling saat dropdown sedang dibuka */
        .form-select option {
            padding: 10px;
            font-weight: 500;
        }
        
        /* Styling untuk input group saat di-hover */
        .input-group:hover .input-group-text {
            background-color: #e2e8f0 !important;
            transition: all 0.2s;
        }

        /* Pastikan form responsif di layar kecil */
        @media (max-width: 768px) {
            .row.g-3 > [class*="col-"] {
                margin-bottom: 0.5rem;
            }
        }
    </style>
</head>
<body>

    <div class="app-wrapper">
        
        <!-- Pembungkus Sidebar -->
        <div id="sidebar-wrapper">
            @include('layouts.sidebar')
        </div>
        
        <!-- Area Konten Utama -->
        <div id="page-content-wrapper">
            <!-- Panggil Header (Sticky) -->
            <div class="sticky-top">
                @include('layouts.header')
            </div>
            
            <main class="p-4 flex-grow-1">
                <!-- Alert Flash Message -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
    
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- SCRIPT UNTUK MINIMIZE SIDEBAR -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('toggleSidebar');
            const sidebarWrapper = document.getElementById('sidebar-wrapper');

            toggleBtn.addEventListener('click', function() {
                sidebarWrapper.classList.toggle('closed');
            });
        });
    </script>

    @stack('scripts')
</body>
</html>