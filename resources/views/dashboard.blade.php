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
                                    <h3 class="font-weight-bold">
                                        @if (Auth::user()->status == 'Admin')
                                            Administrator
                                        @elseif(Auth::user()->status == 'Staff')
                                            Staff
                                        @else
                                            Gudang
                                        @endif
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 grid-margin transparent">
                            <div class="row">
                                @if(Auth::user()->status == 'Admin')
                                <div class="col-md-3 mb-4 stretch-card transparent">
                                    <div class="card card-tale">
                                        <div class="card-body">
                                            <p class="mb-4">Total User</p>
                                            <p class="fs-30 mb-2">{{ $countUser }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(Auth::user()->status == 'Staff' || Auth::user()->status == 'Admin')
                                <div class="col-md-3 mb-4 stretch-card transparent">
                                    <div class="card card-tale">
                                        <div class="card-body">
                                            <p class="mb-4">Total Supply</p>
                                            <p class="fs-30 mb-2">{{ $countSupply }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(Auth::user()->status == 'Admin')
                                <div class="col-md-3 mb-4 stretch-card transparent">
                                    <div class="card card-dark-blue">
                                        <div class="card-body">
                                            <p class="mb-4">Total Officer</p>
                                            <p class="fs-30 mb-2">{{ $countOfficer }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(Auth::user()->status == 'Gudang' || Auth::user()->status == 'Admin')
                                <div class="col-md-3 mb-4 stretch-card transparent">
                                    <div class="card card-light-blue">
                                        <div class="card-body">
                                            <p class="mb-4">Total Incoming</p>
                                            <p class="fs-30 mb-2">{{ $countIncomings }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(Auth::user()->status == 'Staff' || Auth::user()->status == 'Admin')
                                <div class="col-md-3 mb-4 stretch-card transparent">
                                    <div class="card card-light-danger">
                                        <div class="card-body">
                                            <p class="mb-4">Total BOM</p>
                                            <p class="fs-30 mb-2">{{ $countBOM }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4 stretch-card transparent">
                                    <div class="card card-light-danger">
                                        <div class="card-body">
                                            <p class="mb-4">Total WO</p>
                                            <p class="fs-30 mb-2">{{ $countWO }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
