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
                <h3>Detail Obat {{ $data->nama }}
                    @if ($data->stok <= 5) <span class="badge badge-lg light badge-warning">Stok Keritis</span>
                        @else
                        <span class="badge badge-lg light badge-success">Stok Tersedia</span>
                        @endif
                </h3>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route($prefix.'.index') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route($prefix.'.medicine.index') }}">Obat</a></li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </div>
    </div>

    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <label><strong>Kode Obat :</strong></label>
                    <p>{{ $data->kode }}</p>

                    <label><strong>Nama Obat :</strong></label>
                    <p>{{ $data->nama }}</p>

                    <label><strong>Kategori :</strong></label>
                    <p>{{ $data->category->name }}</p>

                    <label><strong>Ditambah Oleh :</strong></label>
                    <p>{{ $data->user->name }}</p>

                    <label><strong>Harga :</strong></label>
                    <p>{{ $data->harga }}</p>

                    <label><strong>Stok :</strong></label>
                    <p>{{ $data->stok }} {{ $data->satuan }}</p>

                    <label><strong>Tanggal Masuk :</strong></label>
                    <p>{{ Carbon\Carbon::parse($data['tgl_masuk'])->format('d M Y') }}</p>

                </div>
            </div>

        </div>

    </div>
</div>

@endsection
