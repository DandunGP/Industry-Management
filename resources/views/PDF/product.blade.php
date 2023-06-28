@extends('PDF.layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col text-center">
                <h3>Laporan Supply</h3>
                <h6>{{ $date }}</h6>
            </div>
        </div>
        <div class="row mt-5">
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                        <th>Qty</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $pd)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pd->product_code }}</td>
                            <td>{{ $pd->product_name }}</td>
                            <td>{{ $pd->qty }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
