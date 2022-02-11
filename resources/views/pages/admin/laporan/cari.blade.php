@extends('layouts.admin')

@section('content')
<!-- row -->
@php
$pre= Request::route()->getPrefix();
$prefix = substr($pre, 1);
@endphp
<div class="container-fluid">

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h3>Laporan Apel</h3>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route($prefix.'.index') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Laporan Apel</li>
            </ol>
        </div>
    </div>

    <div class="row">

        <div class="col-12">
            <div class="row">
                <div class="col-12 col-md-6">
                    <form method="POST" action="{{ route($prefix.'.transaction.laporan')  }}">
                        @csrf
                        <div class="form-group">
                            <label>Dari Tanggal :</label>
                            <input type="date" class="form-control" name="from" required>
                        </div>
                        <div class="form-group">
                            <label>Sampai Tanggal :</label>
                            <input type="date" class="form-control" name="to" required>
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>
</div>

{{-- Delete --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

@endsection
