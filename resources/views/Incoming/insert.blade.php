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
                                    <h3 class="font-weight-bold">Tambah Barang Masuk</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="card p-4">
                                <div class="card-body">
                                    <form action="{{ route('storeIncoming') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="no_bpb">No BPB</label>
                                            <input type="text"
                                                class="form-control w-25 @error('no_bpb') is-invalid @enderror"
                                                id="no_bpb" name="no_bpb" required value="{{ old('no_bpb') }}">
                                            @error('no_bpb')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="no_po">No PO</label>
                                            <input type="text"
                                                class="form-control w-25 @error('no_po') is-invalid @enderror"
                                                id="no_po" name="no_po" required value="{{ old('no_po') }}">
                                            @error('no_po')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="po_date">Tanggal PO</label>
                                            <input type="date"
                                                class="form-control date-field w-25 @error('po_date') is-invalid @enderror"
                                                id="po_date" name="po_date" required value="{{ old('po_date') }}">
                                            @error('po_date')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="supplier">Supplier</label>
                                            <input type="text"
                                                class="form-control w-25 @error('supplier') is-invalid @enderror"
                                                id="supplier" name="supplier" required
                                                value="{{ old('supplier') }}">
                                            @error('supplier')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <label for="supplier">Supply</label>
                                        <div class="d-block mb-3">
                                            <button type="button" id="toggle-supplier" class="btn btn-sm btn-primary"
                                                onclick="toggleSupplier()">Tambah Supplier</button>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" aria-label="Default select example"
                                                name="id_supply" id="id_supply">
                                                <option selected>Pilih Barang</option>
                                                @foreach ($supply as $sp)
                                                    <option value="{{ $sp->id }}">{{ $sp->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="input-total-supply" id="input-total-supply">
                                            <div class="form-group">
                                                <label for="qty">Jumlah Supply</label>
                                                <input type="number"
                                                    class="int-valid form-control w-25 @error('qty') is-invalid @enderror"
                                                    id="qty" name="qty" value="{{ old('qty') }}">
                                                @error('qty')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="input-supply" style="display: none" id="input_supply">
                                            <div class="form-group">
                                                <label for="supply_code">Kode Supply</label>
                                                <input type="text"
                                                    class="form-control w-25 @error('supply_code') is-invalid @enderror"
                                                    id="supply_code" name="supply_code" value="{{ old('supply_code') }}"
                                                    disabled>
                                                @error('supply_code')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Nama Supply</label>
                                                <input type="text"
                                                    class="form-control w-50 @error('name') is-invalid @enderror"
                                                    id="name" name="name" value="{{ old('name') }}" disabled>
                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="type">Tipe</label>
                                                <select name="type" id="type" class="form-control w-25" disabled>
                                                    <option value="FG">Finishing Good</option>
                                                    <option value="WO">Work Order</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="category">Kategori</label>
                                                <select name="category" id="category" class="form-control w-25" disabled>
                                                    <option value="Mentah">Mentah</option>
                                                    <option value="Jadi"> Jadi</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="warehouse">Warehouse</label>
                                                <select name="warehouse_id" id="warehouse" class="form-control w-25"
                                                    disabled>
                                                    @foreach ($warehouses as $warehouse)
                                                        <option value="{{ $warehouse->id }}">{{ $warehouse->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="merk">Merk</label>
                                                <input type="text"
                                                    class="form-control w-25 @error('merk') is-invalid @enderror"
                                                    id="merk" name="merk" value="{{ old('merk') }}" disabled>
                                                @error('merk')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="memo">Memo</label>
                                                <textarea class="form-control @error('memo') is-invalid @enderror" id="memo" name="memo" cols="30"
                                                    rows="5" disabled>{{ old('memo') }}</textarea>
                                                @error('memo')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="part_number">Part Number</label>
                                                <input type="text"
                                                    class="form-control w-25 @error('part_number') is-invalid @enderror"
                                                    id="part_number" name="part_number" value="{{ old('part_number') }}"
                                                    disabled>
                                                @error('part_number')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="qty">Jumlah Supply</label>
                                                <input type="number"
                                                    class="int-valid form-control w-25 @error('qty') is-invalid @enderror"
                                                    id="qty" name="qty" value="{{ old('qty') }}" disabled>
                                                @error('qty')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select name="status" id="status" class="form-control w-25 mb-4"
                                                    disabled>
                                                    <option value="Active">Active</option>
                                                    <option value="Not Activer">Not Active</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="purchase_price">Harga Beli</label>
                                                <input type="number" name="purchase_price" id="purchase_price"
                                                    class="int-valid form-control w-25 @error('purchase_price') is-invalid @enderror"
                                                    value="{{ old('purchase_price') }}" disabled>
                                                @error('purchase_price')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="selling_price">Harga Jual</label>
                                                <input type="number" name="selling_price" id="selling_price"
                                                    class="int-valid form-control w-25 @error('selling_price') is-invalid @enderror"
                                                    value="{{ old('selling_price') }}" disabled>
                                                @error('selling_price')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Alamat</label>
                                            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" cols="30"
                                                rows="5">{{ old('address') }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="no_sj_supplier">No SJ Supplier</label>
                                            <input type="text"
                                                class="form-control w-25 @error('no_sj_supplier') is-invalid @enderror"
                                                id="no_sj_supplier" name="no_sj_supplier" required
                                                value="{{ old('no_sj_supplier') }}">
                                            @error('no_sj_supplier')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="information">Information</label>
                                            <textarea class="form-control @error('information') is-invalid @enderror" id="information" name="information"
                                                cols="30" rows="5" required>{{ old('information') }}</textarea>
                                            @error('information')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <a href="{{ route('dashboardWarehouse') }}"
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
            <script src="{{ asset('js/addSupplyInIncomings.js') }}"></script>
            <script>
                var today = new Date();
                today.setHours(0, 0, 0, 0);

                var dateInput = document.getElementById('po_date');

                dateInput.addEventListener('input', function() {
                var selectedDate = new Date(dateInput.value);

                if (selectedDate >= today) {
                    alert("Invalid date. Please select a date before today.");
                    dateInput.value = '';
                    dateInput.classList.add('invalid-date');
                } else{
                    dateInput.classList.remove('invalid-date');
                }
                });


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
