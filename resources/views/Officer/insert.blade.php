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
                <h3 class="font-weight-bold">Tambah Pegawai</h3>
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
                <form  action="{{route('storeOfficer')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group">
                    <label for="nik">NIK</label>
                    <input type="number" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" required value="{{ old('nik') }}">
                    @error('nik')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group">
                    <label for="dob">Tanggal Lahir</label>
                    <input type="date" id="date-input" class="form-control w-25 @error('dob') is-invalid @enderror" id="dob" name="dob" required value="{{ old('dob') }}">
                    @error('dob')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group">
                    <label for="gender">Jenis Kelamin</label>
                    <select name="gender" id="gender" class="form-control">
                        <option value="Laki-laki" class="form-control" selected>Laki-laki</option>
                        <option value="Perempuan" class="form-control">Perempuan</option>
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <textarea class="form-control" name="address" id="address" cols="30" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                    <label for="phone">Nomor Handphone</label>
                    <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" required value="{{ old('phone') }}">
                    @error('phone')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group">
                    <label for="position">Jabatan</label>
                    <select name="position" id="position" class="form-control">
                        <option value="Manager">Manager</option>
                        <option value="Staff">Staff</option>
                        <option value="Gudang">Gudang</option>
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="officer_picture">Foto</label>
                        <input type="file" name="officer_picture" class="form-control">
                    </div>
                    <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control w-50 @error('username') is-invalid @enderror" id="username" name="username" required value="{{ old('username') }}">
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

<script>
var dateInput = document.getElementById('date-input');

var currentDate = new Date();

var minDate = new Date();
minDate.setFullYear(currentDate.getFullYear() - 17);

dateInput.max = minDate.toISOString().split('T')[0];

dateInput.addEventListener('input', function() {
  var inputDate = new Date(dateInput.value);

  if (inputDate > minDate) {
    dateInput.value = '';
    alert('Please select a date that is at least 17 years ago.');
  }
});

// Password Validation
// const passwordInput = document.getElementById('password');
// const confirmInput = document.getElementById('confirm_password');
// const passwordMessage = document.getElementById('password-message');

// // Add an input event listener to the second password input field
// password2Input.addEventListener('input', validatePasswords);

// function validatePasswords() {
// // Get the values of both password inputs
// const password1 = password1Input.value;
// const password2 = password2Input.value;

// // Check if the passwords match
// if (password1 === password2) {
//     passwordMessage.textContent = 'Passwords match';
// } else {
//     passwordMessage.textContent = 'Passwords do not match';
// }
// }
// </script>

@endsection