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
                        <div class="mt-3">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" onclick="handleDelete({{ $officer->id }})"><i class="ti-trash mr-2"></i>Hapus Pegawai</button>
                        <a href="{{route('editOfficer', $officer->id)}}" class="btn btn-warning"><i class="ti-pencil-alt mr-2"></i> Ubah Data</a>
                        </div>
                    </div>
                </div>
            </div>
            @if (session()->has('deleted'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <div class="d-flex">
                <svg aria-hidden="true" class="ml-2 mt-1" style="width: 25px; height: 25px;" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                <p class="ml-2 mt-2 font-weight-bold">{{ session('deleted') }}</p>
              </div>
              <button type="button" class="close mt-2" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
    
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div>
            <button type="button" class="close mt-4 mr-5 justify-content-end " data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body d-flex flex-column ">
            <h3 class="text-center text-muted">Anda yakin akan menghapus data ini?</h3>
          </div>
          <div class="modal-footer mx-auto mb-4">
            <form id="formDelete" method="POST">
              @method('delete')
              @csrf
              <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Tidak</button>
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