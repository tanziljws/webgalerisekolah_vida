@extends('layouts.admin')

@section('page-title', 'Testimoni')
@section('title', 'Testimoni - Admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Testimoni</h3>
                    <div class="d-flex gap-2">
                        <!-- Filter Status -->
                        <form method="GET" class="d-flex">
                            <select name="status" class="form-select form-select-sm me-2" onchange="this.form.submit()">
                                <option value="">Semua Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </form>
                        
                        <!-- Search -->
                        <form method="GET" class="d-flex">
                            <input type="text" name="search" class="form-control form-control-sm me-2" placeholder="Cari nama atau email..." value="{{ request('search') }}" style="width: 200px;">
                            <button type="submit" class="btn btn-primary btn-sm">Cari</button>
                            @if(request('search') || request('status'))
                                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary btn-sm ms-1">Reset</a>
                            @endif
                        </form>
                    </div>
                </div>
                <div class="card-body p-0">
                    <!-- Testimonials Table -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" style="width: 50px;">No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Pesan</th>
                                    <th class="text-center" style="width: 100px;">Status</th>
                                    <th class="text-center" style="width: 120px;">Tanggal Dibuat</th>
                                    <th class="text-center" style="width: 150px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($testimonials as $index => $testimonial)
                                <tr>
                                    <td class="text-center">{{ $testimonials->firstItem() + $index }}</td>
                                    <td>{{ $testimonial->nama }}</td>
                                    <td>{{ $testimonial->email }}</td>
                                    <td>
                                        <div class="text-truncate" style="max-width: 200px;" title="{{ $testimonial->pesan }}">
                                            {{ Str::limit($testimonial->pesan, 50) }}
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @if($testimonial->status == 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif($testimonial->status == 'approved')
                                            <span class="badge bg-success">Disetujui</span>
                                        @else
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $testimonial->created_at->format('d M Y') }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <!-- View Modal Button -->
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal{{ $testimonial->id }}" title="Lihat Detail">Lihat</button>
                                            
                                            @if($testimonial->status == 'pending')
                                                <!-- Approve Button -->
                                                <button type="button" class="btn btn-success btn-sm" onclick="updateStatus({{ $testimonial->id }}, 'approved')" title="Setujui">Setujui</button>
                                                
                                                <!-- Reject Button -->
                                                <button type="button" class="btn btn-danger btn-sm" onclick="updateStatus({{ $testimonial->id }}, 'rejected')" title="Tolak">Tolak</button>
                                            @elseif($testimonial->status == 'approved')
                                                <!-- Reject Button -->
                                                <button type="button" class="btn btn-warning btn-sm" onclick="updateStatus({{ $testimonial->id }}, 'rejected')" title="Tolak">Tolak</button>
                                            @else
                                                <!-- Approve Button -->
                                                <button type="button" class="btn btn-success btn-sm" onclick="updateStatus({{ $testimonial->id }}, 'approved')" title="Setujui">Setujui</button>
                                            @endif
                                            
                                            <!-- Delete Button -->
                                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteTestimonial({{ $testimonial->id }})" title="Hapus">Hapus</button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- View Modal -->
                                <div class="modal fade" id="viewModal{{ $testimonial->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title">Detail Testimoni</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <h6 class="fw-normal text-primary">Nama:</h6>
                                                        <p class="mb-0">{{ $testimonial->nama }}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h6 class="fw-normal text-primary">Email:</h6>
                                                        <p class="mb-0">{{ $testimonial->email }}</p>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <h6 class="fw-normal text-primary">Status:</h6>
                                                        @if($testimonial->status == 'pending')
                                                            <span class="badge bg-warning text-dark">Pending</span>
                                                        @elseif($testimonial->status == 'approved')
                                                            <span class="badge bg-success">Disetujui</span>
                                                        @else
                                                            <span class="badge bg-danger">Ditolak</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h6 class="fw-normal text-primary">Tanggal:</h6>
                                                        <p class="mb-0">{{ $testimonial->created_at->format('d M Y H:i') }}</p>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <h6 class="fw-normal text-primary">Pesan:</h6>
                                                    <div class="border rounded p-3 bg-light">
                                                        <p class="mb-0 fst-italic">{{ $testimonial->pesan }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                @if($testimonial->status == 'pending')
                                                    <button type="button" class="btn btn-success" onclick="updateStatus({{ $testimonial->id }}, 'approved')">Setujui</button>
                                                    <button type="button" class="btn btn-danger" onclick="updateStatus({{ $testimonial->id }}, 'rejected')">Tolak</button>
                                                @endif
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="text-muted">
                                            <h5 class="text-muted">Belum ada testimoni</h5>
                                            <p class="text-muted">Testimoni yang dikirim pengunjung akan muncul di sini.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($testimonials->hasPages())
                        <div class="d-flex justify-content-center py-3 border-top">
                            {{ $testimonials->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Alert Container -->
<div id="alertContainer" class="position-fixed top-0 end-0 p-3" style="z-index: 1050;"></div>

<style>
/* Custom styles for testimonials table */
.table th {
    font-weight: 500;
    font-size: 14px;
    border-bottom: 2px solid #dee2e6;
}

.table td {
    font-size: 14px;
    vertical-align: middle;
}

.btn-group .btn {
    margin: 0 1px;
}

.badge {
    font-size: 11px;
    padding: 4px 8px;
}

.modal-header {
    border-bottom: 1px solid #dee2e6;
}

.modal-footer {
    border-top: 1px solid #dee2e6;
}

/* Hover effects */
.table tbody tr:hover {
    background-color: #f8f9fa;
}

.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.75rem;
}

/* Status badges */
.badge.bg-warning {
    background-color: #ffc107 !important;
    color: #000 !important;
}

.badge.bg-success {
    background-color: #198754 !important;
}

.badge.bg-danger {
    background-color: #dc3545 !important;
}
</style>

<script>
function updateStatus(id, status) {
    if (!confirm(`Apakah Anda yakin ingin ${status === 'approved' ? 'menyetujui' : 'menolak'} testimoni ini?`)) {
        return;
    }

    fetch(`/admin/testimonials/${id}/status`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ status: status })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            showAlert('success', data.message);
            setTimeout(() => {
                location.reload();
            }, 1500);
        } else {
            showAlert('danger', data.message || 'Terjadi kesalahan');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('danger', 'Terjadi kesalahan saat memperbarui status: ' + error.message);
    });
}

function deleteTestimonial(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus testimoni ini?')) {
        return;
    }

    fetch(`/admin/testimonials/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            showAlert('success', data.message);
            setTimeout(() => {
                location.reload();
            }, 1500);
        } else {
            showAlert('danger', data.message || 'Terjadi kesalahan');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('danger', 'Terjadi kesalahan saat menghapus testimoni: ' + error.message);
    });
}

function showAlert(type, message) {
    const alertContainer = document.getElementById('alertContainer');
    const alertId = 'alert-' + Date.now();
    
    alertContainer.innerHTML += `
        <div id="${alertId}" class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    
    // Auto hide after 5 seconds
    setTimeout(() => {
        const alert = document.getElementById(alertId);
        if (alert) {
            alert.remove();
        }
    }, 5000);
}
</script>
@endsection

