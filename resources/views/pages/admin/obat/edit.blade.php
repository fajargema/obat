@extends('layouts.admin')

@section('content')

@if ($errors->any())
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <span class="badge badge-lg light badge-danger mb-2">There's something wrong!</span>

            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-lg-12">
                            <ul class="list-icons">
                                @foreach ($errors->all() as $error)
                                <li><span class="align-middle mr-2"><i class="ti-angle-right"></i></span> {{ $error }}
                                </li>
                                <li></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@php
$pre= Request::route()->getPrefix();
$prefix = substr($pre, 1);
@endphp

<div class="container-fluid">

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h3>Edit Obat</h3>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route($prefix.'.index') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route($prefix.'.medicine.index') }}">Obat</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Edit</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form action="{{ route($prefix.'.medicine.update', $data->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Nama Obat</label>
                            <input type="text" class="form-control" placeholder="Masukan Nama Obat" name="nama"
                                value="{{ old('nama') ?? $data->nama }}">
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select id="inputState" class="form-control" name="categories_id">
                                <option selected>------Pilih Kategori------</option>
                                @foreach($category as $item)
                                <option value="{{ $item->id }}" @if($data->categories_id === $item->id)
                                    selected="selected" @endif>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Satuan Obat</label>
                            <select id="inputState" class="form-control" name="satuan">
                                <option>------Pilih Satuan------</option>
                                <option selected value="{{ $data->satuan }}">{{ $data->satuan }} (Sekarang)</option>
                                <option value="Botol">Botol</option>
                                <option value="PCS">PCS</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Harga Obat</label>
                            <input type="number" class="form-control" placeholder="Masukan Harga Obat" name="harga"
                                value="{{ old('harga') ?? $data->harga }}">
                        </div>

                        <div class="form-group">
                            <label>Stok Obat</label>
                            <input type="number" class="form-control" placeholder="Masukan Stok Obat" name="stok"
                                value="{{ old('stok') ?? $data->stok }}">
                        </div>

                        <div class="form-group">
                            <label>Tanggal Masuk</label>
                            <input type="date" class="form-control" name="tgl_masuk"
                                value="{{ Carbon\Carbon::parse(old('tgl_masuk') ?? $data->tgl_masuk)->format('Y-m-d') }}">
                        </div>

                        <div class="form-group">
                            <label>Produsen Obat</label>
                            <input type="text" class="form-control" placeholder="Masukan Nama Produsen" name="produsen"
                                value="{{ old('produsen') ?? $data->produsen }}">
                        </div>

                        <div class="form-group">
                            <label>Distributor Obat</label>
                            <input type="text" class="form-control" placeholder="Masukan Nama Distributor"
                                name="distributor" value="{{ old('distributor') ?? $data->distributor }}">
                        </div>


                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
</div>

<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'description' );
</script>
@endsection
