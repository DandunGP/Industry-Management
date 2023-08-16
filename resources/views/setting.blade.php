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
            <h3 class="font-weight-bold">Pegawai</h3>
          </div>
          <div class="col-12 col-xl-4">
            <div class="justify-content-end d-flex">
            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
              <button class="btn btn-sm btn-light bg-white" type="button" disabled>
                {{ date('j, F Y') }}
              </button>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="card p-4">
          <div class="card-body">
            <div class="d-flex mb-3">
                <div class="col-md-4">
                    <div class="card mb-3 ml-5 mt-5" style="max-width: 19rem;">
                        <div class="card-header d-flex justify-content-center rounded text-white" style="background-color: #4B49AC">Foto</div>
                    </div>
                    <div class="card mb-3 ml-5" style="max-width: 19rem;">
                        <div class="card-body d-flex justify-content-center border rounded" style="background-color: #fff">
                            @if($officer->officer_picture != "")
                            <img src="{{$officer->officer_picture}}" alt="officer_picture" style="width: 16rem; height:20rem;">
                            @else
                            <img src="{{asset('images/foto-default.jpg')}}" alt="officer_picture" style="width: 16rem; height:20rem;">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card-body mt-4">
                        <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" required value="{{ $officer->name }}" disabled>
                        </div>
                        <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="number" class="form-control" id="nik" name="nik" required value="{{ $officer->nik }}" disabled>
                        </div>
                        <div class="form-group">
                        <label for="dob">Tanggal Lahir</label>
                        <input type="date" class="form-control w-25" id="dob" name="dob" required value="{{ $officer->date_of_birth }}" disabled>
                        </div>
                        <div class="form-group">
                        <label for="gender">Jenis Kelamin</label>
                        <select name="gender" id="gender" class="form-control" disabled>
                            <option value="Laki-laki" class="form-control" @if($officer->gender == 'Laki-laki') selected @else @endif>Laki-laki</option>
                            <option value="Perempuan" class="form-control" @if($officer->gender == 'Perempuan') selected @else @endif>Perempuan</option>
                        </select>
                        </div>
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea class="form-control" name="address" id="address" cols="30" rows="5" disabled>{{ $officer->address }}</textarea>
                        </div>
                        <div class="form-group">
                        <label for="phone">Nomor Handphone</label>
                        <input type="number" class="form-control" id="phone" name="phone" required value="{{ $officer->phone }}" disabled>
                        </div>
                        <div class="form-group">
                        <label for="position">Jabatan</label>
                        <select name="position" id="position" class="form-control" disabled>
                            <option value="Manager" @if($officer->position == 'Manager') selected @else @endif>Manager</option>
                            <option value="Staff" @if($officer->position == 'Staff') selected @else @endif>Staff</option>
                            <option value="Gudang" @if($officer->position == 'Gudang') selected @else @endif>Gudang</option>
                        </select>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="phone" name="username" required value="{{ $user->username }}" disabled>
                            </div>
                        <div class="mt-3">
                        <a href="{{route('settingUserEdit', $officer->id)}}" class="btn btn-warning"><i class="ti-pencil-alt mr-2"></i> Ubah Data</a>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  function handleDelete(id){
    document.getElementById('formDelete').action = `../../officer/delete/${id}`
  }
</script>
@endsection