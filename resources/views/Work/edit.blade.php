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
                                    <h3 class="font-weight-bold">Edit WO</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="card p-4">
                                <div class="card-body">
                                    <form action="{{ route('updateWork', $work->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="no_wo">No WO</label>
                                            <input type="text"
                                                class="form-control w-25 @error('no_wo') is-invalid @enderror"
                                                id="no_wo" name="no_wo" required value="{{ $work->no_wo }}">
                                            @error('no_wo')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="wo_date">Tanggal WO</label>
                                            <input type="date"
                                                class="form-control w-25 @error('wo_date') is-invalid @enderror"
                                                id="wo_date" name="wo_date" required value="{{ $work->wo_date }}">
                                            @error('wo_date')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="qty">Qty</label>
                                            <input type="number"
                                                class="form-control w-25 @error('qty') is-invalid @enderror" id="qty"
                                                name="qty" required value="{{ $work->qty }}">
                                            @error('qty')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="information">Informasi</label>
                                            <textarea class="form-control @error('information') is-invalid @enderror" id="information" name="information"
                                                cols="30" rows="5" required>{{ $work->information }}</textarea>
                                            @error('information')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="warehouse_id">Gudang</label>
                                            <select name="warehouse_id" id="warehouse" class="form-control w-25">
                                                @foreach ($warehouse as $wh)
                                                    @if ($wh->id == $work->warehouse_id)
                                                        <option value="{{ $wh->id }}" selected>
                                                            {{ $wh->name }}</option>
                                                    @else
                                                        <option value="{{ $wh->id }}">{{ $wh->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="plan_warehouse">Gudang Rencana</label>
                                            <select name="plan_warehouse" id="warehouse" class="form-control w-25">
                                                @foreach ($warehouse as $wh)
                                                    @if ($wh->id == $work->plan_warehouse)
                                                        <option value="{{ $wh->id }}" selected>
                                                            {{ $wh->name }}</option>
                                                    @else
                                                        <option value="{{ $wh->id }}">{{ $wh->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="type">Tipe Product</label>
                                            <select name="type" id="type" class="form-control w-25">
                                                <option value="FG"
                                                    @if ($work->type == 'FG') selected @else @endif>Finishing Good
                                                </option>
                                                <option value="WO"
                                                    @if ($work->type == 'WO') selected @else @endif>Work Order
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="qty_result">Hasil Qty</label>
                                            <input type="number" name="qty_result" id="qty_result"
                                                class="form-control w-25 @error('qty_result') is-invalid @enderror" required
                                                value="{{ $work->qty_result }}">
                                            @error('qty_result')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <a href="{{ route('workDashboard') }}" class="btn btn-primary">Kembali</a>
                                            <button type="submit" class="btn btn-success">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
