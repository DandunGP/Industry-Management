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
                                    <h3 class="font-weight-bold">Bill Of Materials</h3>
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
                                        <a href="{{ route('addBill') }}"
                                            class="btn btn-primary btn-sm mb-3 font-weight-bold my-auto"><i
                                                class="ti-plus mr-2"></i>Tambah Bill</a>
                                        <form action="{{ route('searchBill') }}" method="post">
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
                                                    <th scope="col">No BOM</th>
                                                    <th scope="col">Kode BOM</th>
                                                    <th scope="col">Kode Supply</th>
                                                    <th scope="col">Kode Warehouse</th>
                                                    <th scope="col">Nama BOM</th>
                                                    <th scope="col">Tipe Product</th>
                                                    <th scope="col">Qty</th>
                                                    <th scope="col">Harga</th>
                                                    <th scope="col">Informasi</th>
                                                    <th scope="col">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($bom[0] == null)
                                                    <tr>
                                                        <td colspan="12" class="text-center">Tidak ada data bill of materials</td>
                                                    </tr>
                                                @else
                                                    @foreach ($bom as $bm)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $bm->no_bom }}</td>
                                                            <td>{{ $bm->bom_code }}</td>
                                                            <td>{{ $bm->supply->supply_code }}</td>
                                                            <td>{{ $bm->warehouse->warehouse_code }}</td>
                                                            <td>{{ $bm->name }}</td>
                                                            <td>{{ $bm->type_product }}</td>
                                                            <td>{{ $bm->qty }}</td>
                                                            <td>{{ $bm->amount_cost }}</td>
                                                            <td>{{ $bm->information }}</td>
                                                            <td>
                                                                <a href="/siswa/{{ $bm->id }}"
                                                                    class="btn btn-info btn-sm"><i class="ti-eye"></i></a>
                                                                <a href="{{ route('editBill', $bm->id) }}"
                                                                    class="btn btn-warning btn-sm"><i
                                                                        class="ti-pencil-alt"></i></a>
                                                                <button type="button" class="btn btn-danger btn-sm"
                                                                    data-toggle="modal" data-target="#exampleModal"
                                                                    onclick="handleDelete({{ $bm->id }})"><i
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
                                            {{ $bom->links() }}
                                        </div>
                                    </div>
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
                    document.getElementById('formDelete').action = `bill-of-materials/delete/${id}`
                }
            </script>
        @endsection
