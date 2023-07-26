@extends('Layouts.HeaderDashboard')    

@section('content')

<div class="container-scroller">

@include('Layouts.NavbarDashboard')
    
<div class="container-fluid page-body-wrapper">

@include('Layouts.SidebarDashboard')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Edit User ( Gudang )</h3>
                </div>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin">
            <div class="card p-4">
                <div class="card-body">
                    @if (session('alert'))
                    <div class="alert alert-{{ session('alert.type') }}">
                        {{ session('alert.message') }}
                    </div>
                    @endif
                <form  action="{{route('updateUserWarehouse', $user->id)}}" method="POST">
                    @csrf
                    <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control w-50 @error('username') is-invalid @enderror" id="username" name="username" required value="{{ $user->username }}">
                    @error('username')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control w-50 @error('password') is-invalid @enderror" id="password" name="password" required value="{{ old('password') }}">
                    @error('password')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Konfirmasi Password</label>
                        <input type="password" class="form-control w-50 @error('confirm_password') is-invalid @enderror" id="confirm_password" name="confirm_password" required value="{{ old('confirm_password') }}">
                        @error('confirm_password')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                        </div>
                    <div class="form-group">
                    <label for="status">Posisi</label>
                    <select name="status" id="status" class="form-control w-50">
                        <option value="Admin" class="form-control" @if($user->status == 'Admin') selected @else @endif>Admin</option>
                        <option value="Staff" class="form-control" @if($user->status == 'Staff') selected @else @endif>Staff</option>
                        <option value="Gudang" class="form-control" @if($user->status == 'Gudang') selected @else @endif>Gudang</option>
                    </select>
                    </div>
                    <div class="mt-3">
                    <a href="{{route('warehouseDashboard')}}" class="btn btn-primary">Kembali</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection