@extends('layouts.app')
@section('title', isset($pegawai) ? 'Edit Pegawai' : 'Tambah Pegawai')
@section('page_title', isset($pegawai) ? 'Form Edit Pegawai' : 'Form Tambah Pegawai')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow border-0" style="border-radius: 15px;">
            
            <!-- Header Form -->
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 d-flex justify-content-between align-items-start">
                <div>
                    <h5 class="fw-bold mb-1 text-primary">
                        <i class="bi bi-person-plus-fill me-2"></i> {{ isset($pegawai) ? 'Form Edit Data Pegawai' : 'Form Tambah Pegawai Baru' }}
                    </h5>
                    <p class="text-muted small">Silakan lengkapi data personal pegawai di bawah ini secara akurat.</p>
                </div>
                <a href="{{ route('pegawai.index') }}" class="btn-close" aria-label="Close"></a>
            </div>
            
            <div class="card-body pt-3">
                <form action="{{ isset($pegawai) ? route('pegawai.update', $pegawai->id) : route('pegawai.store') }}" method="POST">
                    @csrf
                    @if(isset($pegawai))
                        @method('PUT')
                    @endif
                    
                    <div class="row">
                        <!-- Input Nama -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-muted small">Nama Pegawai <span class="text-danger">*</span></label>
                            <input type="text" name="nama_pegawai" class="form-control form-control-lg bg-light @error('nama_pegawai') is-invalid @enderror" value="{{ old('nama_pegawai', $pegawai->nama_pegawai ?? '') }}" placeholder="Contoh: Budi Santoso" required>
                            @error('nama_pegawai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input Jenis Kelamin -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-muted small">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="jenis_kelamin" class="form-select form-select-lg bg-light @error('jenis_kelamin') is-invalid @enderror" required>
                                <option value="" disabled {{ old('jenis_kelamin', $pegawai->jenis_kelamin ?? '') == '' ? 'selected' : '' }}>Pilih jenis kelamin...</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin', $pegawai->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $pegawai->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input Pendidikan -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-muted small">Pendidikan Terakhir <span class="text-danger">*</span></label>
                            <select name="pendidikan_terakhir" class="form-select form-select-lg bg-light @error('pendidikan_terakhir') is-invalid @enderror" required>
                                <option value="" disabled {{ old('pendidikan_terakhir', $pegawai->pendidikan_terakhir ?? '') == '' ? 'selected' : '' }}>Pilih pendidikan...</option>
                                <option value="SMA/SMK" {{ old('pendidikan_terakhir', $pegawai->pendidikan_terakhir ?? '') == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                                <option value="D3" {{ old('pendidikan_terakhir', $pegawai->pendidikan_terakhir ?? '') == 'D3' ? 'selected' : '' }}>D3</option>
                                <option value="S1" {{ old('pendidikan_terakhir', $pegawai->pendidikan_terakhir ?? '') == 'S1' ? 'selected' : '' }}>S1</option>
                                <option value="S2" {{ old('pendidikan_terakhir', $pegawai->pendidikan_terakhir ?? '') == 'S2' ? 'selected' : '' }}>S2</option>
                            </select>
                            @error('pendidikan_terakhir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input Tanggal Lahir -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-muted small">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_lahir" class="form-control form-control-lg bg-light @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir', $pegawai->tanggal_lahir ?? '') }}" required>
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input Status (BARU) -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-muted small">Status Pegawai <span class="text-danger">*</span></label>
                            <select name="status" class="form-select form-select-lg bg-light @error('status') is-invalid @enderror" required>
                                <option value="Aktif" {{ old('status', $pegawai->status ?? 'Aktif') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Cuti" {{ old('status', $pegawai->status ?? '') == 'Cuti' ? 'selected' : '' }}>Cuti</option>
                                <option value="Resign" {{ old('status', $pegawai->status ?? '') == 'Resign' ? 'selected' : '' }}>Resign</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('pegawai.index') }}" class="btn btn-light border px-4">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save me-1"></i> {{ isset($pegawai) ? 'Update Data' : 'Simpan Data' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection