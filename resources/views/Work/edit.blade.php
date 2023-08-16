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
                                            <label for="no_wo">No WO<span class="text-danger">(*)</span></label>
                                            <input type="text"
                                                class="form-control w-25 @error('no_wo') is-invalid @enderror"
                                                id="no_wo" name="no_wo" required value="{{ $work->no_wo }}" readonly>
                                            @error('no_wo')
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
                                            <label for="plan_warehouse">Gudang Rencana<span class="text-danger">(*)</span></label>
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
                                            <label for="qty_result">Hasil Qty<span class="text-danger">(*)</span></label>
                                            <input type="number" name="qty_result" id="qty_result"
                                                class="int-valid form-control w-25 @error('qty_result') is-invalid @enderror" required
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

            <script>
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
