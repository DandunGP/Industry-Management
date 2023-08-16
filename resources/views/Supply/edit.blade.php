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
                                    <h3 class="font-weight-bold">Edit Persediaan Barang</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="card p-4">
                                <div class="card-body">
                                    <form action="{{ route('updateSupply', $supply->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="supply_code">Kode Supply<span class="text-danger">(*)</span></label>
                                            <input type="text"
                                                class="form-control w-25 @error('supply_code') is-invalid @enderror"
                                                id="supply_code" name="supply_code" required
                                                value="{{ $supply->supply_code }}">
                                            @error('supply_code')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Nama Supply<span class="text-danger">(*)</span></label>
                                            <input type="text"
                                                class="form-control w-50 @error('name') is-invalid @enderror" id="name"
                                                name="name" required value="{{ $supply->name }}">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="type">Tipe<span class="text-danger">(*)</span></label>
                                            <select name="type" id="type" class="form-control w-25">
                                                <option value="FG"
                                                    @if ($supply->type == 'FG') selected @else @endif>Finishing Good
                                                </option>
                                                <option value="WO"
                                                    @if ($supply->type == 'WO') selected @else @endif>Work Order
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="category">Kategori<span class="text-danger">(*)</span></label>
                                            <select name="category" id="category" class="form-control w-25">
                                                <option value="Mentah"
                                                    @if ($supply->category == 'Mentah') selected @else @endif>Mentah</option>
                                                <option value="Jadi"
                                                    @if ($supply->category == 'Jadi') selected @else @endif> Jadi</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="warehouse">Warehouse<span class="text-danger">(*)</span></label>
                                            <select name="warehouse_id" id="warehouse" class="form-control w-25">
                                                @foreach ($warehouses as $warehouse)
                                                    <option value="{{ $warehouse->id }}"
                                                        @if ($warehouse->id == $supply->warehouse_id) selected @endif>
                                                        {{ $warehouse->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="merk">Merk<span class="text-danger">(*)</span></label>
                                            <input type="text"
                                                class="form-control w-25 @error('merk') is-invalid @enderror" id="merk"
                                                name="merk" required value="{{ $supply->merk }}">
                                            @error('merk')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="memo">Memo<span class="text-danger">(*)</span></label>
                                            <textarea class="form-control @error('memo') is-invalid @enderror" id="memo" name="memo" cols="30"
                                                rows="5" required>{{ $supply->memo }}</textarea>
                                            @error('memo')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="part_number">Part Number<span class="text-danger">(*)</span></label>
                                            <input type="text"
                                                class="form-control w-25 @error('part_number') is-invalid @enderror"
                                                id="part_number" name="part_number" required
                                                value="{{ $supply->part_number }}">
                                            @error('part_number')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="qty">Jumlah Supply<span class="text-danger">(*)</span></label>
                                            <input type="number"
                                                class="int-valid form-control w-25 @error('qty') is-invalid @enderror" id="qty"
                                                name="qty" required value="{{ $supply->qty }}">
                                            @error('qty')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status<span class="text-danger">(*)</span></label>
                                            <select name="status" id="status" class="form-control w-25 mb-4">
                                                <option value="Active"
                                                    @if ($supply->status == 'Active') selected @else @endif>Active</option>
                                                <option value="Not Active"
                                                    @if ($supply->status == 'Not Active') selected @else @endif>Not Active
                                                </option>
                                            </select>
                                            <div class="form-group">
                                                <label for="purchase_price">Harga Beli<span class="text-danger">(*)</span></label>
                                                <input type="number" name="purchase_price" id="purchase_price"
                                                    class="int-valid form-control w-25 @error('purchase_price') is-invalid @enderror"
                                                    required value="{{ $supply->purchase_price }}">
                                                @error('purchase_price')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="selling_price">Harga Jual<span class="text-danger">(*)</span></label>
                                                <input type="number" name="selling_price" id="selling_price"
                                                    class="int-valid form-control w-25 @error('selling_price') is-invalid @enderror"
                                                    required value="{{ $supply->selling_price }}">
                                                @error('selling_price')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <span class="text-danger">(*)</span> Kolom wajib di isi
                                            <div class="mt-3">
                                                <a href="{{ route('supplyDashboard') }}"
                                                    class="btn btn-primary">Kembali</a>
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
