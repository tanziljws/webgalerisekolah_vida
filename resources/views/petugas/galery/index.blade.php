@extends('layouts.petugas')

@section('title', 'Galeri - Petugas SMKN 4 BOGOR')
@section('page-title', 'Galeri')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Daftar Galeri</h5>
                    <a href="{{ route('petugas.galery.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Tambah Galeri
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Post</th>
                                    <th class="d-none d-md-table-cell">Position</th>
                                    <th>Foto</th>
                                    <th class="d-none d-lg-table-cell">Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($galeries as $index => $galery)
                                <tr>
                                    <td>{{ $galeries->firstItem() + $index }}</td>
                                    <td>
                                        <div class="fw-bold">{{ Str::limit($galery->post->judul, 40) }}</div>
                                        <small class="text-muted d-lg-none">
                                            Posisi: {{ $galery->position }} | 
                                            <span class="badge bg-{{ (int)$galery->status === 1 ? 'success' : 'secondary' }} badge-sm">
                                                {{ (int)$galery->status === 1 ? 'Aktif' : 'Nonaktif' }}
                                            </span>
                                        </small>
                                    </td>
                                    <td class="d-none d-md-table-cell">{{ $galery->position }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-primary rounded-pill">{{ $galery->fotos->count() }}</span>
                                    </td>
                                    <td class="d-none d-lg-table-cell">
                                        <span class="badge bg-{{ (int)$galery->status === 1 ? 'success' : 'secondary' }}">
                                            {{ (int)$galery->status === 1 ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('petugas.galery.show', $galery) }}" class="btn btn-sm btn-info" title="Lihat">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('petugas.galery.edit', $galery) }}" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('petugas.galery.destroy', $galery) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus"
                                                        onclick="return confirm('Yakin ingin menghapus galeri ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <p class="text-muted mb-0">Belum ada galeri</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $galeries->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
