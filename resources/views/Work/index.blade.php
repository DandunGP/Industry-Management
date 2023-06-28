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
                                    <h3 class="font-weight-bold">Work Order</h3>
                                </div>
                                <div class="col-12 col-xl-4">
                                    <div class="justify-content-end d-flex">
                                        <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                            <button class="btn btn-sm btn-light bg-white" type="button" disabled>
                                                {{ date('j, F Y') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="card p-4">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-3">
                                        <a href="{{ route('addWork') }}"
                                            class="btn btn-primary btn-sm mb-3 font-weight-bold my-auto"><i
                                                class="ti-plus mr-2"></i>Tambah Work Order</a>
                                        <form action="{{ route('searchWork') }}" method="post">
                                            @csrf
                                            <input type="text" name="keyword" class="form-control" placeholder="Search"
                                                aria-label="Search...">
                                        </form>
                                    </div>
                                    @if (session()->has('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <div class="d-flex">
                                                <svg aria-hidden="true" class="ml-2 mt-1" style="width: 25px; height: 25px;"
                                                    fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                <p class="ml-2 mt-2 font-weight-bold">{{ session('success') }}</p>
                                            </div>
                                            <button type="button" class="close mt-2" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    @if (session()->has('deleted'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <div class="d-flex">
                                                <svg aria-hidden="true" class="ml-2 mt-1" style="width: 25px; height: 25px;"
                                                    fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                <p class="ml-2 mt-2 font-weight-bold">{{ session('deleted') }}</p>
                                            </div>
                                            <button type="button" class="close mt-2" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped" width="10px">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">No WO</th>
                                                    <th scope="col">Tanggal WO</th>
                                                    <th scope="col">Qty</th>
                                                    <th scope="col">Informasi</th>
                                                    <th scope="col">Gudang</th>
                                                    <th scope="col">Rencana Gudang</th>
                                                    <th scope="col">Tipe</th>
                                                    <th scope="col">Jumlah Hasil</th>
                                                    <th scope="col">Biaya</th>
                                                    <th scope="col">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($work[0] == null)
                                                    <tr>
                                                        <td colspan="12" class="text-center">Tidak ada data bill of
                                                            materials</td>
                                                    </tr>
                                                @else
                                                    @foreach ($work as $index_wo => $wo)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $wo->no_wo }}</td>
                                                            <td>{{ $wo->wo_date }}</td>
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
                                                            <td>
                                                                <a href="/siswa/{{ $wo->id }}"
                                                                    class="btn btn-info btn-sm"><i class="ti-eye"></i></a>
                                                                <a href="{{ route('editWork', $wo->id) }}"
                                                                    class="btn btn-warning btn-sm"><i
                                                                        class="ti-pencil-alt"></i></a>
                                                                <button type="button" class="btn btn-danger btn-sm"
                                                                    data-toggle="modal" data-target="#exampleModal"
                                                                    onclick="handleDelete({{ $wo->id }})"><i
                                                                        class="ti-trash"></i></button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex">
                                        <div class="mt-3 mx-auto">
                                            {{ $work->links() }}
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-3">
                                            <h6>Print Laporan Work Order</h6>
                                        </div>
                                    </div>
                                    <form action="{{ route('printWork') }}" method="post">
                                        @csrf
                                        <div class="row align-items-center">
                                            <div class="col-3">
                                                <input type="date" name="tanggal1" class="form-control">
                                            </div>
                                            <div class="col-3">
                                                <input type="date" name="tanggal2" class="form-control">
                                            </div>
                                            <div class="col-6">
                                                <button type="submit" class="btn btn-primary">Print PDF</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div>
                                    <button type="button" class="close mt-4 mr-5 justify-content-end "
                                        data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body d-flex flex-column ">
                                    <h3 class="text-center text-muted">Anda yakin akan menghapus data ini?</h3>
                                </div>
                                <div class="modal-footer mx-auto mb-4">
                                    <form id="formDelete" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                    <button type="button" class="btn btn-outline-light"
                                        data-dismiss="modal">Tidak</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function handleDelete(id) {
                    document.getElementById('formDelete').action = `work-order/delete/${id}`
                }
            </script>
        @endsection
