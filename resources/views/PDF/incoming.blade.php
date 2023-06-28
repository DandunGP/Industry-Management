@extends('PDF.layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col text-center">
                <h3>Laporan Barang Masuk</h3>
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
                        <th scope="col">No BPB</th>
                        <th scope="col">No PO</th>
                        <th scope="col">Tanggal PO</th>
                        <th scope="col">Tanggal Penerimaan</th>
                        <th scope="col">Supplier</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">No SJ Supplier</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Informasi</th>
                    </tr>
                </thead>
                <tbody style="font-size: 6px">
                    @foreach ($incomings as $inc)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $inc->no_bpb }}</td>
                            <td>{{ $inc->no_po }}</td>
                            <td>{{ date('j F Y', strtotime($inc->po_date)) }}</td>
                            <td>{{ date('j F Y', strtotime($inc->date_of_receipt)) }}</td>
                            <td>{{ $inc->supplier }}</td>
                            <td>{{ $inc->address }}</td>
                            <td>{{ $inc->no_sj_supplier }}</td>
                            <td>{{ $inc->qty }}</td>
                            <td>{{ $inc->information }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
