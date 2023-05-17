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
                                    <h3 class="font-weight-bold">Tambah Bill</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="card p-4">
                                <div class="card-body">
                                    <form action="{{ route('updateBill', $bom->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="no_bom">NO Bill</label>
                                            <input type="text"
                                                class="form-control w-25 @error('no_bom') is-invalid @enderror"
                                                id="no_bom" name="no_bom" required
                                                value="@if (old('no_bom')) {{ old('no_bom') }} 
                                                @else {{ $bom->no_bom }} @endif">
                                            @error('no_bom')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="bom_code">Kode Bill</label>
                                            <input type="text"
                                                class="form-control w-25 @error('bom_code') is-invalid @enderror"
                                                id="bom_code" name="bom_code" required
                                                value="@if (old('bom_code')) {{ old('bom_code') }} 
                                                @else {{ $bom->bom_code }} @endif">
                                            @error('bom_code')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Nama Bill</label>
                                            <input type="text"
                                                class="form-control w-50 @error('name') is-invalid @enderror" id="name"
                                                name="name" required
                                                value="@if (old('name')) {{ old('name') }} 
                                                @else {{ $bom->name }} @endif">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="information">Informasi</label>
                                            <textarea class="form-control @error('information') is-invalid @enderror" id="information" name="information"
                                                cols="30" rows="5" required>{{ $bom->information }}</textarea>
                                            @error('information')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="supply">Supply Code</label>
                                            <select name="supply_id" id="supply" class="form-control w-25">
                                                @foreach ($supply as $sp)
                                                    <option value="{{ $sp->id }}"
                                                        @if ($sp->id = $bom->supply_id) selected @endif>
                                                        {{ $sp->supply_code }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="warehouse">Warehouse Code</label>
                                            <select name="warehouse_id" id="warehouse" class="form-control w-25">
                                                @foreach ($warehouse as $wh)
                                                    <option value="{{ $wh->id }}"
                                                        @if ($wh->id = $bom->warehouse_id) selected @endif>
                                                        {{ $wh->warehouse_code }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="type">Tipe Product</label>
                                            <select name="type_product" id="type" class="form-control w-25">
                                                <option value="FG" @if ($bom->type_product = 'FG') selected @endif>
                                                    Finishing Good</option>
                                                <option value="WO"@if ($bom->type_product = 'WO') selected @endif>Work
                                                    Order</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="qty">Qty</label>
                                            <input type="number" name="qty" id="qty"
                                                class="form-control w-25 @error('qty') is-invalid @enderror" required
                                                value="{{ $bom->qty }}">
                                            @error('qty')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="amount_cost">Harga</label>
                                            <input type="number" name="amount_cost" id="amount_cost"
                                                class="form-control w-25 @error('amount_cost') is-invalid @enderror"
                                                required value="{{ $bom->amount_cost }}">
                                            @error('amount_cost')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <a href="{{ route('billDashboard') }}" class="btn btn-primary">Kembali</a>
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
