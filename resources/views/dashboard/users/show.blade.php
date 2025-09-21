@extends('layouts.dashboard')

@section('title', 'Detail User')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail User: {{ $user->name }}</h1>
        <div>
            @if(!$user->hasRole('super admin') || $user->id === auth()->id())
                <a href="{{ route('dashboard.users.edit', $user) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i> Edit User
                </a>
            @endif
            <a href="{{ route('dashboard.users.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi User</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="120"><strong>Nama:</strong></td>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Role:</strong></td>
                                    <td>
                                        @if($user->role)
                                            <span class="badge badge-{{ $user->role === 'super admin' ? 'danger' : 'info' }} badge-lg" style="color: white;">
                                                {{ ucwords(str_replace('_', ' ', $user->role)) }}
                                            </span>
                                        @else
                                            <span class="badge badge-secondary" style="color: white;">No Role</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        @if($user->email_verified_at)
                                            <span class="badge badge-success badge-lg">Active</span>
                                        @else
                                            <span class="badge badge-warning badge-lg">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="150"><strong>User ID:</strong></td>
                                    <td>{{ $user->id }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Dibuat:</strong></td>
                                    <td>{{ $user->created_at->format('d F Y, H:i') }} WIB</td>
                                </tr>
                                <tr>
                                    <td><strong>Terakhir Diupdate:</strong></td>
                                    <td>{{ $user->updated_at->format('d F Y, H:i') }} WIB</td>
                                </tr>
                                @if($user->email_verified_at)
                                <tr>
                                    <td><strong>Diverifikasi:</strong></td>
                                    <td>{{ $user->email_verified_at->format('d F Y, H:i') }} WIB</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity Log (Optional - jika ingin menambahkan log aktivitas user) -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Statistik User</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Status Akun
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $user->email_verified_at ? 'Aktif' : 'Tidak Aktif' }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-{{ $user->email_verified_at ? 'check-circle' : 'times-circle' }} fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Level Akses
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ ucwords(str_replace('_', ' ', $user->role ?? 'No Role')) }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-shield fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Bergabung Sejak
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $user->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Actions Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Aksi</h6>
                </div>
                <div class="card-body">
                    @if($user->role !== 'super admin' || $user->id === auth()->id())
                        <a href="{{ route('dashboard.users.edit', $user) }}" class="btn btn-warning btn-block mb-2">
                            <i class="fas fa-edit"></i> Edit User
                        </a>
                    @endif

                    @if($user->role !== 'super admin' || $user->id === auth()->id())
                        <form action="{{ route('dashboard.users.toggle-status', $user) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-{{ $user->email_verified_at ? 'secondary' : 'success' }} btn-block mb-2">
                                <i class="fas fa-{{ $user->email_verified_at ? 'ban' : 'check' }}"></i> 
                                {{ $user->email_verified_at ? 'Nonaktifkan' : 'Aktifkan' }} User
                            </button>
                        </form>
                    @endif

                    @if($user->role !== 'super admin' && $user->id !== auth()->id())
                        <form action="{{ route('dashboard.users.destroy', $user) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-block mb-2" 
                                    onclick="return confirm('Yakin ingin menghapus user ini? Tindakan ini tidak dapat dibatalkan!')">
                                <i class="fas fa-trash"></i> Hapus User
                            </button>
                        </form>
                    @endif

                    <a href="{{ route('dashboard.users.index') }}" class="btn btn-secondary btn-block">
                        <i class="fas fa-list"></i> Kembali ke Daftar
                    </a>
                </div>
            </div>

            <!-- Security Info -->
            
        </div>
    </div>
</div>
@endsection