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
                <h3 class="font-weight-bold">Edit Pegawai</h3>
                </div>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin">
            <div class="card p-4">
                <div class="card-body">
                <form  action="{{route('updateOfficer', $officer->id)}}" method="POST">
                    @csrf
                    <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{ $officer->name }}">
                    @error('name')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group">
                    <label for="nik">NIK</label>
                    <input type="number" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" required value="{{ $officer->nik }}">
                    @error('nik')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group">
                    <label for="dob">Tanggal Lahir</label>
                    <input type="date" class="form-control w-25 @error('dob') is-invalid @enderror" id="dob" name="dob" required value="{{ $officer->date_of_birth }}">
                    @error('dob')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group">
                    <label for="gender">Jenis Kelamin</label>
                    <select name="gender" id="gender" class="form-control">
                        <option value="Laki-laki" class="form-control" @if($officer->gender == 'Laki-laki') selected @else @endif>Laki-laki</option>
                        <option value="Perempuan" class="form-control" @if($officer->gender == 'Perempuan') selected @else @endif>Perempuan</option>
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <textarea class="form-control" name="address" id="address" cols="30" rows="5">{{ $officer->address }}</textarea>
                    </div>
                    <div class="form-group">
                    <label for="phone">Nomor Handphone</label>
                    <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" required value="{{ $officer->phone }}">
                    @error('phone')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group">
                    <label for="position">Jabatan</label>
                    <select name="position" id="position" class="form-control">
                        <option value="Manager" @if($officer->position == 'Manager') selected @else @endif>Manager</option>
                        <option value="Staff" @if($officer->position == 'Staff') selected @else @endif>Staff</option>
                        <option value="Gudang" @if($officer->position == 'Gudang') selected @else @endif>Gudang</option>
                    </select>
                    </div>
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
                    @if(Auth::user()->status == 'Admin')
                    <div class="form-group">
                    <label for="status">Posisi</label>
                    <select name="status" id="status" class="form-control w-50">
                        <option value="Admin" class="form-control" @if($user->status == 'Admin') selected @else @endif>Admin</option>
                        <option value="Staff" class="form-control" @if($user->status == 'Staff') selected @else @endif>Staff</option>
                        <option value="Gudang" class="form-control" @if($user->status == 'Gudang') selected @else @endif>Gudang</option>
                    </select>
                    </div>
                    @endif
                    <div class="mt-3">
                    <a href="{{route('officerDashboard')}}" class="btn btn-primary">Kembali</a>
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