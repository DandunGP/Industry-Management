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
                <h3 class="font-weight-bold">Edit Gudang</h3>
                </div>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin">
            <div class="card p-4">
                <div class="card-body">
                <form  action="{{route('updateWarehouse', $warehouse->id)}}" method="POST">
                    @csrf
                    <div class="form-group">
                    <label for="name">Kode Gudang<span class="text-danger">(*)</span></label>
                    <input type="text" class="form-control" name="warehouse_code" id="inlineFormInputGroupUsername2" value="{{ $warehouse->warehouse_code }}" readonly>
                    @error('name')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group">
                    <label for="name">Nama Gudang<span class="text-danger">(*)</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{ $warehouse->name }}">
                    @error('name')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group">
                    <label for="information">Infomasi</label>
                    <textarea class="form-control" name="information" id="information" cols="30" rows="10">{{ $warehouse->information }}</textarea>
                    @error('information')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <span class="text-danger">(*)</span> Kolom wajib di isi
                    <div class="mt-3">
                    <a href="{{route('dashboardWarehouse')}}" class="btn btn-primary">Kembali</a>
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