<div class="card shadow-sm h-100 border-0" style="border-radius: 16px;">
    <div class="card-body p-4 d-flex flex-column justify-content-center">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
                <div class="text-muted fw-semibold mb-1" style="font-size: 0.85rem;">{{ $title }}</div>
                <h2 class="fw-bold mb-0" style="color: #1e293b; font-size: 2.2rem;">{{ $value }}</h2>
            </div>
            <!-- Ikon Card -->
            <div class="rounded-circle d-flex justify-content-center align-items-center" 
                 style="width: 48px; height: 48px; background-color: {{ $bgColor ?? '#eff6ff' }}; color: {{ $iconColor ?? '#3b82f6' }};">
                <i class="bi {{ $icon ?? 'bi-people-fill' }}" style="font-size: 1.3rem;"></i>
            </div>
        </div>
        <div class="text-secondary" style="font-size: 0.8rem;">{{ $subtitle }}</div>
    </div>
</div>