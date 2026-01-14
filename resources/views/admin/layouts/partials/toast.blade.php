{{-- Toast Notification Partial --}}
@if(session('success') || session('error') || session('warning') || session('info'))
<div class="position-fixed top-0 end-0 p-3" style="z-index: 9999;">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow" role="alert" style="min-width: 300px;">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow" role="alert" style="min-width: 300px;">
            <i class="bi bi-shield-exclamation me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('warning'))
        <div class="alert alert-warning alert-dismissible fade show shadow" role="alert" style="min-width: 300px;">
            <i class="bi bi-exclamation-triangle me-2"></i>
            {{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('info'))
        <div class="alert alert-info alert-dismissible fade show shadow" role="alert" style="min-width: 300px;">
            <i class="bi bi-info-circle me-2"></i>
            {{ session('info') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
</div>

<script>
    // Auto-hide alerts after 3 seconds
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 3000);
    });
</script>
@endif
