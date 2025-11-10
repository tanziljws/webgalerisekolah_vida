@extends('layouts.admin')

@section('title', 'Petugas - Admin SMKN 4 BOGOR')
@section('page-title', 'Petugas')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Daftar Petugas</h5>
                    <a href="{{ route('admin.petugas.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Tambah Petugas
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Jumlah Posts</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($petugas as $index => $p)
                                <tr>
                                    <td>{{ $petugas->firstItem() + $index }}</td>
                                    <td>{{ $p->username }}</td>
                                    <td>
                                        <span class="badge bg-primary">{{ $p->posts_count }}</span>
                                    </td>
                                    <td>{{ $p->created_at ? $p->created_at->format('d M Y') : '-' }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.petugas.show', $p) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.petugas.edit', $p) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.petugas.destroy', $p) }}" method="POST" class="d-inline" 
                                                  onsubmit="return confirmDelete('{{ $p->username }}')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada petugas</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center">
                        {{ $petugas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(username) {
            return confirm(`Yakin ingin menghapus petugas "${username}"? Tindakan ini tidak dapat dibatalkan.`);
        }
    </script>
@endsection
