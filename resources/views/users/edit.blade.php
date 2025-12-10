@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Edit User</h4>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('users.update', $user) }}">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <input id="name" type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           name="name" 
                                           value="{{ old('name', $user->name) }}" 
                                           required autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input id="email" type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           name="email" 
                                           value="{{ old('email', $user->email) }}" 
                                           required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Nomor Telepon</label>
                                    <input id="phone" type="text" 
                                           class="form-control @error('phone') is-invalid @enderror" 
                                           name="phone" 
                                           value="{{ old('phone', $user->phone) }}">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select id="role" class="form-select @error('role') is-invalid @enderror" name="role" required>
                                        <option value="">Pilih Role</option>
                                        <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="superadmin" {{ old('role', $user->role) == 'superadmin' ? 'selected' : '' }}>Super Admin</option>
                                    </select>
                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="position" class="form-label">Jabatan</label>
                                    <input id="position" type="text" 
                                           class="form-control @error('position') is-invalid @enderror" 
                                           name="position" 
                                           value="{{ old('position', $user->position) }}">
                                    @error('position')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="department" class="form-label">Departemen</label>
                                    <input id="department" type="text" 
                                           class="form-control @error('department') is-invalid @enderror" 
                                           name="department" 
                                           value="{{ old('department', $user->department) }}">
                                    @error('department')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password Baru (Opsional)</label>
                                    <input id="password" type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           name="password">
                                    <div class="form-text">Kosongkan jika tidak ingin mengubah password</div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                    <input id="password_confirmation" type="password" 
                                           class="form-control" 
                                           name="password_confirmation">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" 
                                               id="is_active" name="is_active" value="1"
                                               {{ old('is_active', $user->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            User Aktif
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update User
                            </button>
                            
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection