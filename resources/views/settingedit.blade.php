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
                <h3 class="font-weight-bold">Edit User</h3>
                </div>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin">
            <div class="card p-4">
                <div class="card-body">
                    <div class="loading-container">
                        <div class="loading-spinner"></div>
                        <div class="loading-text">Uploading image...</div>
                      </div>
                    @if (session('alert'))
                    <div class="alert alert-{{ session('alert.type') }}">
                        {{ session('alert.message') }}
                    </div>
                    @endif
                <form  action="{{route('settingUserStore', $officer->id)}}" method="POST" id="upload-form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                    <label for="name">Nama Lengkap<span class="text-danger">(*)</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{ $officer->name }}">
                    @error('name')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group">
                    <label for="nik">NIK<span class="text-danger">(*)</span></label>
                    <input type="number" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" required value="{{ $officer->nik }}">
                    @error('nik')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group">
                    <label for="dob">Tanggal Lahir<span class="text-danger">(*)</span></label>
                    <input type="date" id="date-input" class="form-control w-25 @error('dob') is-invalid @enderror" id="dob" name="dob" required value="{{ $officer->date_of_birth }}">
                    @error('dob')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group">
                    <label for="gender">Jenis Kelamin<span class="text-danger">(*)</span></label>
                    <select name="gender" id="gender" class="form-control">
                        <option value="Laki-laki" class="form-control" @if($officer->gender == 'Laki-laki') selected @else @endif>Laki-laki</option>
                        <option value="Perempuan" class="form-control" @if($officer->gender == 'Perempuan') selected @else @endif>Perempuan</option>
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat<span class="text-danger">(*)</span></label>
                        <textarea class="form-control" name="address" id="address" cols="30" rows="5">{{ $officer->address }}</textarea>
                    </div>
                    <div class="form-group">
                    <label for="phone">Nomor Handphone<span class="text-danger">(*)</span></label>
                    <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" required value="{{ $officer->phone }}">
                    @error('phone')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group">
                    <label for="position">Jabatan<span class="text-danger">(*)</span></label>
                    <select name="position" id="position" class="form-control">
                        <option value="Manager" @if($officer->position == 'Manager') selected @else @endif>Manager</option>
                        <option value="Staff" @if($officer->position == 'Staff') selected @else @endif>Staff</option>
                        <option value="Gudang" @if($officer->position == 'Gudang') selected @else @endif>Gudang</option>
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="officer_picture">Foto</label>
                        <input type="file" name="officer_picture" id="file-input" class="form-control">
                        <span class="text-danger mt-3" style="font-size: 15px;">Kosongi jika tidak ingin mengganti Foto</span>
                    </div>
                    <div class="form-group">
                    <label for="username">Username<span class="text-danger">(*)</span></label>
                    <input type="text" class="form-control w-50 @error('username') is-invalid @enderror" id="username" name="username" required value="{{ $user->username }}">
                    @error('username')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group">
                    <label for="password">Password<span class="text-danger">(*)</span></label>
                    <input type="password" class="form-control w-50 @error('password') is-invalid @enderror" id="password" name="password" required value="{{ old('password') }}">
                    @error('password')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Konfirmasi Password<span class="text-danger">(*)</span></label>
                        <input type="password" class="form-control w-50 @error('confirm_password') is-invalid @enderror" id="confirm_password" name="confirm_password" required value="{{ old('confirm_password') }}">
                        @error('confirm_password')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                        </div>
                        <span class="text-danger">(*) Kolom wajib di isi</span>
                    <div class="mt-3">
                    <a href="{{route('settingUser', Auth::user()->id)}}" class="btn btn-primary">Kembali</a>
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

    const form = document.getElementById('upload-form');
    const loadingContainer = document.querySelector('.loading-container');

    form.addEventListener('submit', function (e) {
      e.preventDefault();

      loadingContainer.style.display = 'block';

      form.submit();

      setTimeout(function () {
        loadingContainer.style.display = 'none';
      }, 5000);
    });
</script>

@endsection