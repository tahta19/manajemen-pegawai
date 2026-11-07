@extends('layouts.app')
@section('title', 'Dashboard')
@section('page_title', 'Dashboard Eksekutif')

@section('content')

<!-- ========================================== -->
<!-- BARIS 1: STAT CARDS                        -->
<!-- ========================================== -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        @include('components.chart-card', [
            'title' => 'Total Pegawai', 
            'value' => $totalPegawai, 
            'subtitle' => 'Seluruh data pegawai terdaftar',
            'icon' => 'bi-people-fill',
            'bgColor' => '#eff6ff', 
            'iconColor' => '#3b82f6'
        ])
    </div>
    <div class="col-md-4">
        @include('components.chart-card', [
            'title' => 'Pegawai Aktif', 
            'value' => $pegawaiAktif, 
            'subtitle' => 'Pegawai dengan status aktif',
            'icon' => 'bi-person-check-fill',
            'bgColor' => '#dcfce7', 
            'iconColor' => '#10b981'
        ])
    </div>
    <div class="col-md-4">
        @include('components.chart-card', [
            'title' => 'Pendidikan Terbanyak', 
            'value' => $topPendidikan, 
            'subtitle' => $topPendidikanCount . ' Pegawai dengan jenjang ini',
            'icon' => 'bi-mortarboard-fill',
            'bgColor' => '#fef3c7', 
            'iconColor' => '#d97706'
        ])
    </div>
</div>

<!-- ========================================== -->
<!-- BARIS 2: PIE CHARTS (GENDER & STATUS)      -->
<!-- ========================================== -->
<div class="row g-3 mb-4">
    <!-- Pie Gender -->
    <div class="col-md-6">
        <div class="card shadow-sm h-100 border-0" style="border-radius: 16px;">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-4">Distribusi Jenis Kelamin</h6>
                <div class="d-flex justify-content-center" style="height: 250px;">
                    <canvas id="genderChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Pie Status -->
    <div class="col-md-6">
        <div class="card shadow-sm h-100 border-0" style="border-radius: 16px;">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-4">Distribusi Status Kepegawaian</h6>
                <div class="d-flex justify-content-center" style="height: 250px;">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ========================================== -->
<!-- BARIS 3: BAR & LINE CHARTS                 -->
<!-- ========================================== -->
<div class="row g-3 mb-4">
    <!-- Bar Pendidikan -->
    <div class="col-md-6">
        <div class="card shadow-sm h-100 border-0" style="border-radius: 16px;">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-4">Statistik Pendidikan Terakhir</h6>
                <div style="height: 250px;">
                    <canvas id="eduChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Line Usia -->
    <div class="col-md-6">
        <div class="card shadow-sm h-100 border-0" style="border-radius: 16px;">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-4">Demografi Usia Pegawai</h6>
                <div style="height: 250px;">
                    <canvas id="ageChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // --- PENGATURAN GLOBAL CHART.JS ---
    Chart.defaults.font.family = "'Inter', 'Segoe UI', 'Helvetica Neue', Arial, sans-serif";
    Chart.defaults.color = '#64748b';

    // 1. Pie Chart Gender
    const totalGender = {{ $lakiLaki + $perempuan }} || 1; 
    const pctLaki = Math.round(({{ $lakiLaki }} / totalGender) * 100);
    const pctPerempuan = Math.round(({{ $perempuan }} / totalGender) * 100);

    new Chart(document.getElementById('genderChart'), {
        type: 'doughnut',
        data: {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{ 
                data: [{{ $lakiLaki }}, {{ $perempuan }}], 
                backgroundColor: ['#3b82f6', '#ec4899'],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: { 
            cutout: '65%',
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        boxWidth: 8,
                        padding: 20,
                        font: { size: 13, weight: '500' },
                        generateLabels: function(chart) {
                            const data = chart.data;
                            if (data.labels.length && data.datasets.length) {
                                return data.labels.map(function(label, i) {
                                    const meta = chart.getDatasetMeta(0);
                                    const style = meta.controller.getStyle(i);
                                    const percentage = i === 0 ? pctLaki : pctPerempuan;
                                    return {
                                        text: `${label} (${percentage}%)`,
                                        fillStyle: style.backgroundColor,
                                        strokeStyle: style.backgroundColor,
                                        lineWidth: 0,
                                        pointStyle: 'circle',
                                        hidden: isNaN(data.datasets[0].data[i]) || meta.data[i].hidden,
                                        index: i
                                    };
                                });
                            }
                            return [];
                        }
                    }
                }
            }
        }
    });

    // 2. Pie Chart Status
    const statusLabels = {!! json_encode($statusData->keys()) !!};
    const statusValues = {!! json_encode($statusData->values()) !!};
    
    const statusColors = statusLabels.map(label => {
        if (label === 'Aktif') return '#10b981';
        if (label === 'Cuti') return '#f59e0b';
        if (label === 'Resign') return '#ef4444';
        return '#6b7280';
    });

    new Chart(document.getElementById('statusChart'), {
        type: 'doughnut',
        data: {
            labels: statusLabels,
            datasets: [{ 
                data: statusValues,
                backgroundColor: statusColors,
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            cutout: '65%',
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom', labels: { usePointStyle: true, boxWidth: 8, padding: 20 } }
            }
        }
    });

    // 3. Bar Chart Pendidikan
    new Chart(document.getElementById('eduChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($eduData->keys()) !!},
            datasets: [{ 
                label: 'Jumlah',
                data: {!! json_encode($eduData->values()) !!}, 
                backgroundColor: ['#3b82f6', '#10b981', '#6366f1', '#f59e0b'],
                borderRadius: 6,
                barPercentage: 0.6
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { 
                y: { beginAtZero: true, ticks: { stepSize: 10 }, grid: { borderDash: [4, 4], color: '#f1f5f9' } },
                x: { grid: { display: false } }
            }
        }
    });

    // 4. Line Chart Usia (Sesuai desain awal)
    new Chart(document.getElementById('ageChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode(array_keys($usiaData)) !!},
            datasets: [{
                label: 'Jumlah Pegawai',
                data: {!! json_encode(array_values($usiaData)) !!},
                borderColor: '#f59e0b',
                backgroundColor: 'rgba(245, 158, 11, 0.1)',
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#f59e0b',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { 
                y: { beginAtZero: true, ticks: { stepSize: 10 }, grid: { borderDash: [4, 4], color: '#f1f5f9' } },
                x: { grid: { display: false } }
            }
        }
    });
</script>
@endpush