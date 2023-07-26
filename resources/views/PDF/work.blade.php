@extends('PDF.layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col text-center">
                <h3>Laporan Work Order</h3>
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
                        <th scope="col">No WO</th>
                        <th scope="col">Nama WO</th>
                        <th scope="col">Tanggal WO</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Informasi</th>
                        <th scope="col">Gudang</th>
                        <th scope="col">Rencana Gudang</th>
                        <th scope="col">Tipe</th>
                        <th scope="col">Jumlah Hasil</th>
                        <th scope="col">Biaya</th>
                    </tr>
                </thead>
                <tbody style="font-size: 6px">
                    @foreach ($works as $index_wo => $wo)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $wo->no_wo }}</td>
                            <td>{{ $wo->billOfMaterial->name }}</td>
                            <td>{{ date('j F Y', strtotime($wo->created_at)) }}</td>
                            <td>{{ $wo->qty }}</td>
                            <td>{{ $wo->information }}</td>
                            <td>{{ $wo->warehouse->warehouse_code }}</td>
                            <td>{{ $wo->planWarehouse->warehouse_code }}</td>
                            <td>{{ $wo->type }}</td>
                            <td>{{ $wo->qty_result }}</td>
                            <td>
                                @foreach ($amounts as $index_amount => $amount)
                                    @if ($index_wo == $index_amount)
                                        {{ $amount }}
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
