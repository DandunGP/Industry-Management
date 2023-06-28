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
                                            @foreach ($bom->bill_supply as $bm_sp)
                                                <div class="d-flex">
                                                    <select name="supply_id_old[]" id="supply"
                                                        class="form-control w-25 mb-2">
                                                        @foreach ($supply as $sp)
                                                            <option value="{{ $sp->id }}"
                                                                @if ($sp->id == $bm_sp->supply_id) selected @endif>
                                                                {{ $sp->supply_code }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <input type="number" name="qty_supply_old[]"
                                                        class="form-control w-25 mb-2 mx-2" value="{{ $bm_sp->qty }}">
                                                    @if ($bom->bill_supply->count() > 1)
                                                        <a href="{{ route('deleteBillSupply', $bm_sp->id) }}"
                                                            class="btn">Hapus</a>
                                                    @endif
                                                </div>
                                            @endforeach
                                            <div id="input-supply">
                                                {{-- input --}}
                                            </div>
                                            <button type="button" class="btn btn-primary" onclick="addSelect()">Tambah
                                                Select</button>
                                        </div>
                                        <div class="form-group">
                                            <label for="warehouse">Warehouse Code</label>
                                            <select name="warehouse_id" id="warehouse" class="form-control w-25">
                                                @foreach ($warehouse as $wh)
                                                    <option value="{{ $wh->id }}"
                                                        @if ($wh->id = $bom->warehouse_id) selected @endif>
                                                        {{ $wh->name }}</option>
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
            <script>
                var count = 1;

                function addSelect() {
                    var selectContainer = document.getElementById('input-supply');

                    var divElement = document.createElement('div');
                    divElement.id = 'input' + count;
                    divElement.setAttribute('class', 'd-flex align-items-center');

                    var selectElement = document.createElement('select');
                    selectElement.setAttribute('name', 'supply_id[]');
                    selectElement.setAttribute('class', 'form-control w-25 mb-2')

                    // Laravel Blade syntax to loop through options
                    @foreach ($supply as $sp)
                        var optionElement = document.createElement('option');
                        optionElement.setAttribute('value', '{{ $sp->id }}');
                        optionElement.textContent = '{{ $sp->name }}';
                        selectElement.appendChild(optionElement);
                    @endforeach
                    divElement.appendChild(selectElement);

                    var inputElement = document.createElement('input');
                    inputElement.setAttribute('name', 'qty_supply[]');
                    inputElement.setAttribute('class', 'form-control w-25 mb-2 mx-2');
                    inputElement.setAttribute('type', 'number');
                    divElement.appendChild(inputElement);

                    var deleteButton = document.createElement('button');
                    deleteButton.textContent = 'Hapus';
                    deleteButton.setAttribute('type', 'button');
                    deleteButton.setAttribute('class', 'btn')
                    deleteButton.setAttribute('onclick', 'removeInput(' + count + ')');
                    divElement.appendChild(deleteButton);


                    selectContainer.appendChild(divElement);

                    selectCount++;
                }

                function removeInput(inputId) {
                    var inputElement = document.getElementById('input' + inputId);
                    inputElement.remove();
                }
            </script>
        @endsection
