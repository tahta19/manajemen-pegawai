@extends('layouts.app')
@section('title', 'Data Pegawai')
@section('page_title', 'Kelola Data Pegawai')

@section('content')

<!-- ========================================== -->
<!-- BAGIAN 1: FORM TAMBAH / EDIT (DI ATAS)     -->
<!-- ========================================== -->
<div class="card shadow-sm border-0 mb-4" style="border-radius: 12px;">
    <div class="card-header bg-white border-bottom-0 pt-4 pb-0 d-flex justify-content-between align-items-start">
        <div>
            <h5 class="fw-bold mb-1 text-primary">
                <i class="bi {{ isset($editPegawai) ? 'bi-pencil-square' : 'bi-person-plus-fill' }} me-2"></i> 
                {{ isset($editPegawai) ? 'Form Edit Data Pegawai' : 'Form Tambah Pegawai Baru' }}
            </h5>
            <p class="text-muted small">Silakan lengkapi data personal pegawai di bawah ini secara akurat.</p>
        </div>
        @if(isset($editPegawai))
            <a href="{{ route('pegawai.index') }}" class="btn-close" aria-label="Close" title="Batal Edit"></a>
        @endif
    </div>
    
    <div class="card-body">
        <form action="{{ isset($editPegawai) ? route('pegawai.update', $editPegawai->id) : route('pegawai.store') }}" method="POST">
            @csrf
            @if(isset($editPegawai))
                @method('PUT')
            @endif
            
            <div class="row g-3">
                <!-- BARIS 1: Nama, NIP, & Tanggal Lahir -->
                <div class="col-md-4">
                    <label class="form-label fw-semibold text-muted small">Nama Pegawai <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted"><i class="bi bi-person"></i></span>
                        <input type="text" name="nama_pegawai" class="form-control bg-light @error('nama_pegawai') is-invalid @enderror" value="{{ old('nama_pegawai', $editPegawai->nama_pegawai ?? '') }}" placeholder="Nama Lengkap" required>
                    </div>
                    @error('nama_pegawai') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold text-muted small">NIP</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted"><i class="bi bi-card-list"></i></span>
                        <input type="text" name="nip" class="form-control bg-light @error('nip') is-invalid @enderror" value="{{ old('nip', $editPegawai->nip ?? '') }}" placeholder="Contoh: 199008201">
                    </div>
                    @error('nip') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold text-muted small">Tanggal Lahir <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted"><i class="bi bi-calendar-date"></i></span>
                        <input type="date" name="tanggal_lahir" class="form-control bg-light @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir', $editPegawai->tanggal_lahir ?? '') }}" required>
                    </div>
                    @error('tanggal_lahir') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <!-- BARIS 2: Pendidikan, Jurusan, Gender, Status -->
                <div class="col-md-3">
                    <label class="form-label fw-semibold text-muted small">Pendidikan <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted"><i class="bi bi-mortarboard"></i></span>
                        <select name="pendidikan_terakhir" class="form-select bg-light @error('pendidikan_terakhir') is-invalid @enderror" required>
                            <option value="" disabled {{ old('pendidikan_terakhir', $editPegawai->pendidikan_terakhir ?? '') == '' ? 'selected' : '' }}>-- Pilih --</option>
                            <option value="SMA/SMK" {{ old('pendidikan_terakhir', $editPegawai->pendidikan_terakhir ?? '') == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                            <option value="D3" {{ old('pendidikan_terakhir', $editPegawai->pendidikan_terakhir ?? '') == 'D3' ? 'selected' : '' }}>D3</option>
                            <option value="S1" {{ old('pendidikan_terakhir', $editPegawai->pendidikan_terakhir ?? '') == 'S1' ? 'selected' : '' }}>S1</option>
                            <option value="S2" {{ old('pendidikan_terakhir', $editPegawai->pendidikan_terakhir ?? '') == 'S2' ? 'selected' : '' }}>S2</option>
                        </select>
                    </div>
                    @error('pendidikan_terakhir') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold text-muted small">Jurusan</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted"><i class="bi bi-book"></i></span>
                        <input type="text" name="jurusan" class="form-control bg-light @error('jurusan') is-invalid @enderror" value="{{ old('jurusan', $editPegawai->jurusan ?? '') }}" placeholder="Teknik Informatika">
                    </div>
                    @error('jurusan') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold text-muted small">Jenis Kelamin <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted"><i class="bi bi-gender-ambiguous"></i></span>
                        <select name="jenis_kelamin" class="form-select bg-light @error('jenis_kelamin') is-invalid @enderror" required>
                            <option value="" disabled {{ old('jenis_kelamin', $editPegawai->jenis_kelamin ?? '') == '' ? 'selected' : '' }}>-- Pilih --</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin', $editPegawai->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin', $editPegawai->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    @error('jenis_kelamin') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold text-muted small">Status <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted"><i class="bi bi-info-circle"></i></span>
                        <select name="status" class="form-select bg-light @error('status') is-invalid @enderror" required>
                            <option value="Aktif" {{ old('status', $editPegawai->status ?? 'Aktif') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Cuti" {{ old('status', $editPegawai->status ?? '') == 'Cuti' ? 'selected' : '' }}>Cuti</option>
                            <option value="Resign" {{ old('status', $editPegawai->status ?? '') == 'Resign' ? 'selected' : '' }}>Resign</option>
                        </select>
                    </div>
                    @error('status') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>
            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-end gap-2">
                @if(isset($editPegawai))
                    <a href="{{ route('pegawai.index') }}" class="btn btn-light border px-4">Batal</a>
                @endif
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-save me-1"></i> {{ isset($editPegawai) ? 'Update Data' : 'Simpan Data' }}
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ========================================== -->
<!-- BAGIAN 2: FILTER & PENCARIAN               -->
<!-- ========================================== -->
<div class="card shadow-sm border-0 mb-4" style="border-radius: 12px;">
    <div class="card-body p-3">
        <form action="{{ route('pegawai.index') }}" method="GET" class="d-flex gap-2 flex-wrap">
            <div class="input-group flex-grow-1" style="min-width: 200px;">
                <span class="input-group-text bg-white text-muted border-end-0"><i class="bi bi-search"></i></span>
                <input type="text" name="q" class="form-control border-start-0" placeholder="Cari nama atau NIP..." value="{{ request('q') }}">
            </div>
            
            <select name="pendidikan" class="form-select w-auto" onchange="this.form.submit()">
                <option value="">Semua Pendidikan</option>
                <option value="SMA/SMK" {{ request('pendidikan') == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                <option value="D3" {{ request('pendidikan') == 'D3' ? 'selected' : '' }}>D3</option>
                <option value="S1" {{ request('pendidikan') == 'S1' ? 'selected' : '' }}>S1</option>
                <option value="S2" {{ request('pendidikan') == 'S2' ? 'selected' : '' }}>S2</option>
            </select>

            <select name="gender" class="form-select w-auto" onchange="this.form.submit()">
                <option value="">Semua Gender</option>
                <option value="Laki-laki" {{ request('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ request('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>

            <select name="status" class="form-select w-auto" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="Cuti" {{ request('status') == 'Cuti' ? 'selected' : '' }}>Cuti</option>
                <option value="Resign" {{ request('status') == 'Resign' ? 'selected' : '' }}>Resign</option>
            </select>

            <div class="d-flex align-items-center px-3 bg-primary bg-opacity-10 text-primary rounded" style="font-size: 0.85rem; font-weight: 600;">
                {{ $pegawai->total() }} Pegawai
            </div>

            @if(request('q') || request('pendidikan') || request('gender') || request('status'))
                <a href="{{ route('pegawai.index') }}" class="btn btn-light border">Reset</a>
            @endif
        </form>
    </div>
</div>

<!-- ========================================== -->
<!-- BAGIAN 3: TABEL DATA                       -->
<!-- ========================================== -->
<div class="card shadow-sm border-0" style="border-radius: 12px;">
    <div class="card-body p-0">
        <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light" style="position: sticky; top: 0; z-index: 1;">
                    <tr>
                        <th class="ps-4 text-center">NO</th>
                        <th>NAMA PEGAWAI</th>
                        <th>JENIS KELAMIN</th>
                        <th>PENDIDIKAN & JURUSAN</th>
                        <th>TANGGAL LAHIR (USIA)</th>
                        <th class="text-center">STATUS</th>
                        <th class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pegawai as $index => $p)
                        <tr>
                            <td class="ps-4 text-center fw-bold">{{ $pegawai->firstItem() + $index }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center me-3 fw-bold" style="width: 40px; height: 40px; font-size: 0.85rem;">
                                        {{ substr($p->nama_pegawai, 0, 2) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold" style="color: #1e293b;">{{ $p->nama_pegawai }}</div>
                                        <!-- NIP Dinamis -->
                                        <small class="text-muted">NIP: {{ $p->nip ?? '-' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($p->jenis_kelamin == 'Laki-laki')
                                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill"><i class="bi bi-gender-male"></i> Laki-laki</span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill"><i class="bi bi-gender-female"></i> Perempuan</span>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold" style="color: #1e293b;">{{ $p->pendidikan_terakhir }}</div>
                                <!-- Jurusan Dinamis -->
                                <small class="text-muted">{{ $p->jurusan ?? '-' }}</small>
                            </td>
                            <td>
                                <div class="fw-bold" style="color: #1e293b;">{{ \Carbon\Carbon::parse($p->tanggal_lahir)->format('d M Y') }}</div>
                                <small class="text-muted">{{ $p->usia }} Tahun</small>
                            </td>
                            <td class="text-center">
                                @if($p->status == 'Aktif')
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill"><i class="bi bi-check-circle"></i> Aktif</span>
                                @elseif($p->status == 'Cuti')
                                    <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill"><i class="bi bi-clock"></i> Cuti</span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill"><i class="bi bi-x-circle"></i> Resign</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('pegawai.index', ['edit' => $p->id] + request()->query()) }}" class="btn btn-warning btn-sm fw-bold text-white" style="border-radius: 6px;">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('pegawai.destroy', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm fw-bold" style="border-radius: 6px;">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">
                                <h5>Data tidak ditemukan</h5>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- FOOTER: PAGINATION -->
    <div class="card-footer bg-white border-top-0 pt-4 pb-3">
        <div class="d-flex flex-column align-items-center">
            <small class="text-muted mb-3">Menampilkan {{ $pegawai->firstItem() ?? 0 }} sampai {{ $pegawai->lastItem() ?? 0 }} dari {{ $pegawai->total() }} data</small>
            <div>
                {{ $pegawai->links() }}
            </div>
        </div>
    </div>
</div>

@endsection