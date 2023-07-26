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
                                        @if (session('alert'))
                                        <div class="alert alert-{{ session('alert.type') }}">
                                            {{ session('alert.message') }}
                                        </div>
                                        @endif
                                        <div class="form-group">
                                            <label for="bill_of_material_id">Bill Of Materials</label>
                                            <select name="bill_of_material_id" id="bom" class="form-control w-25">
                                                @foreach ($bom as $bm)
                                                    <option value="{{ $bm->id }}">{{ $bm->name }}</option>
                                                @endforeach
                                            </select>
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
                                            <label for="qty_result">Hasil Qty</label>
                                            <input type="number" name="qty_result" id="qty_result"
                                                class="int-valid form-control w-25 @error('qty_result') is-invalid @enderror" required
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

            <script>
                // Validation Input Int
                const intValidation = document.querySelectorAll('.int-valid');

                intValidation.forEach(function(intValid) {
                    intValid.addEventListener('input', validateInput);
                });

                function validateInput() {
                    intValidation.forEach(function(inputField) {
                        const value = inputField.value;

                        if (value <= 0 || Math.floor(value) !== parseFloat(value)) {
                            inputField.value = '';
                        }
                    });
                }
            </script>
        @endsection
