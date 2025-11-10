@extends('layouts.admin')

@section('title', 'Detail Profile - Admin SMKN 4 BOGOR')
@section('page-title', 'Detail Profile')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Detail Profile</h5>
                    <div>
                        <a href="{{ route('admin.profile.edit', $profile) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Edit
                        </a>
                        <a href="{{ route('admin.profile.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h3>{{ $profile->judul }}</h3>
                            <p class="text-muted">Dibuat pada {{ $profile->created_at->format('d M Y H:i') }}</p>
                            
                            <div class="content">
                                {!! nl2br(e($profile->isi)) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">Informasi Profile</h6>
                                </div>
                                <div class="card-body">
                                    <p><strong>Judul:</strong> {{ $profile->judul }}</p>
                                    <p><strong>Dibuat:</strong> {{ $profile->created_at->format('d M Y H:i') }}</p>
                                    <p><strong>Diupdate:</strong> {{ $profile->updated_at->format('d M Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
