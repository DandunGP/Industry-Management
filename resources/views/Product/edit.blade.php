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
                <h3 class="font-weight-bold">Edit Produk</h3>
                </div>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin">
            <div class="card p-4">
                <div class="card-body">
                <form  action="{{route('updateProduct', $product->id)}}" method="POST">
                    @csrf
                    <div class="form-group">
                    <label for="product_code">Kode Produk</label>
                        <div class="input-group mb-2 mr-sm-2 w-25">
                            <div class="input-group-prepend">
                                <div class="input-group-text">PEPU-</div>
                            </div>
                        <input type="text" class="form-control" name="product_code" id="inlineFormInputGroupUsername2" value="{{ substr($product->product_code, 5) }}">
                        </div>
                    </div>
                    <div class="form-group">
                    <label for="product_name">Nama Produk</label>
                    <input type="text" class="form-control w-50 @error('product_name') is-invalid @enderror" id="product_name" name="product_name" required value="{{ $product->product_name }}">
                    @error('product_name')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group">
                    <label for="qty">Qty</label>
                    <input type="number" class="form-control w-25 @error('qty') is-invalid @enderror" id="qty" name="qty" required value="{{ $product->qty }}">
                    @error('qty')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="mt-3">
                    <a href="{{route('productDashboard')}}" class="btn btn-primary">Kembali</a>
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