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
                <h3 class="font-weight-bold">Edit Barang Masuk</h3>
                </div>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin">
            <div class="card p-4">
                <div class="card-body">
                <form  action="{{route('updateIncoming', $incoming->id)}}" method="POST">
                    @csrf
                    <div class="form-group">
                    <label for="no_bpb">No BPB<span class="text-danger">(*)</span></label>
                    <input type="text" class="form-control w-25 @error('no_bpb') is-invalid @enderror" id="no_bpb" name="no_bpb" required value="{{ $incoming->no_bpb }}">
                    @error('no_bpb')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group">
                    <label for="no_po">No PO<span class="text-danger">(*)</span></label>
                    <input type="text" class="form-control w-25 @error('no_po') is-invalid @enderror" id="no_po" name="no_po" required value="{{ $incoming->no_po }}">
                    @error('no_po')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group">
                    <label for="po_date">Tanggal PO<span class="text-danger">(*)</span></label>
                    <input type="date" class="form-control w-25 @error('po_date') is-invalid @enderror" id="po_date" name="po_date" required value="{{ $incoming->po_date }}">
                    @error('po_date')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group">
                    <label for="supplier">Supplier<span class="text-danger">(*)</span></label>
                    <input type="text" class="form-control @error('supplier') is-invalid @enderror" id="supplier" name="supplier" required value="{{ $incoming->supplier }}">
                    @error('supplier')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group">
                    <label for="address">Alamat<span class="text-danger">(*)</span></label>
                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" cols="30" rows="5" required>{{ $incoming->address }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group">
                    <label for="no_sj_supplier">No SJ Supplier<span class="text-danger">(*)</span></label>
                    <input type="text" class="form-control w-25 @error('no_sj_supplier') is-invalid @enderror" id="no_sj_supplier" name="no_sj_supplier" required value="{{ $incoming->no_sj_supplier }}">
                    @error('no_sj_supplier')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group">
                    <label for="qty">Jumlah Supply<span class="text-danger">(*)</span></label>
                    <input type="number" class="form-control w-25 @error('qty') is-invalid @enderror" id="qty" name="qty" required value="{{ $incoming->qty }}">
                    @error('qty')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group">
                    <label for="information">Information</label>
                    <textarea class="form-control @error('information') is-invalid @enderror" id="information" name="information" cols="30" rows="5" required> {{ $incoming->information }} </textarea>
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