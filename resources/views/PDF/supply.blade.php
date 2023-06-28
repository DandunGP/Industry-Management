@extends('PDF.layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col text-center">
                <h3>Laporan Supply</h3>
                @if ($date && $date2)
                    <h6>{{ $date }} - {{ $date2 }}</h6>
                @endif
            </div>
        </div>
        <div class="row mt-5">
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center" style="font-size: 8px">
                        <th scope="col">No</th>
                        <th scope="col">Kode Supply</th>
                        <th scope="col">Nama Supply</th>
                        <th scope="col">Tipe</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Merk</th>
                        <th scope="col">Memo</th>
                        <th scope="col">Part Number</th>
                        <th scope="col">Status</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Warehouse</th>
                        <th scope="col">Harga Beli</th>
                        <th scope="col">Harga Jual</th>
                    </tr>
                </thead>
                <tbody style="font-size: 6px">
                    @foreach ($supplys as $sp)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sp->supply_code }}</td>
                            <td>{{ $sp->name }}</td>
                            <td>{{ $sp->type }}</td>
                            <td>{{ $sp->category }}</td>
                            <td>{{ $sp->merk }}</td>
                            <td>{{ $sp->memo }}</td>
                            <td>{{ $sp->part_number }}</td>
                            <td>{{ $sp->status }}</td>
                            <td>{{ $sp->qty }}</td>
                            <td>{{ $sp->warehouse->name }}</td>
                            <td>{{ $sp->purchase_price }}</td>
                            <td>{{ $sp->selling_price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
