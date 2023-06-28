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
                                    <h3 class="font-weight-bold">Tambah WO</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="card p-4">
                                <div class="card-body">
                                    <form action="{{ route('storeWork') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="no_wo">No WO</label>
                                            <input type="text"
                                                class="form-control w-25 @error('no_wo') is-invalid @enderror"
                                                id="no_wo" name="no_wo" required value="{{ old('no_wo') }}">
                                            @error('no_wo')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="wo_date">Tanggal WO</label>
                                            <input type="date"
                                                class="form-control w-25 @error('wo_date') is-invalid @enderror"
                                                id="wo_date" name="wo_date" required value="{{ old('wo_date') }}">
                                            @error('wo_date')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="information">Informasi</label>
                                            <textarea class="form-control @error('information') is-invalid @enderror" id="information" name="information"
                                                cols="30" rows="5" required>{{ old('information') }}</textarea>
                                            @error('information')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="warehouse_id">Gudang</label>
                                            <select name="warehouse_id" id="warehouse" class="form-control w-25">
                                                @foreach ($warehouse as $wh)
                                                    <option value="{{ $wh->id }}">{{ $wh->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="bill_of_material_id">BOM</label>
                                            <select name="bill_of_material_id" id="bom" class="form-control w-25">
                                                @foreach ($bom as $bm)
                                                    <option value="{{ $bm->id }}">{{ $bm->bom_code }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="plan_warehouse">Gudang Rencana</label>
                                            <select name="plan_warehouse" id="warehouse" class="form-control w-25">
                                                @foreach ($warehouse as $wh)
                                                    <option value="{{ $wh->id }}">{{ $wh->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="product_name">Nama Produk</label>
                                            <input type="text"
                                                class="form-control w-25 @error('product_name') is-invalid @enderror"
                                                id="product_name" name="product_name" required>
                                            @error('product_name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="type">Tipe Product</label>
                                            <select name="type" id="type" class="form-control w-25">
                                                <option value="FG">Finishing Good</option>
                                                <option value="WO">Work Order</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="qty_result">Hasil Qty</label>
                                            <input type="number" name="qty_result" id="qty_result"
                                                class="form-control w-25 @error('qty_result') is-invalid @enderror" required
                                                value="{{ old('qty_result') }}">
                                            @error('qty_result')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="amount_cost">Biaya</label>
                                            <input type="number" name="amount_cost" id="amount_cost"
                                                class="form-control w-25 @error('amount_cost') is-invalid @enderror"
                                                required value="{{ old('amount_cost') }}">
                                            @error('amount_cost')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div> --}}
                                        <div class="mt-3">
                                            <a href="{{ route('workDashboard') }}" class="btn btn-primary">Kembali</a>
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
