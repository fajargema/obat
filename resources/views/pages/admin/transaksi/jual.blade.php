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
                <h3>Transaksi Obat</h3>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route( $prefix.'.index') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Transaksi Obat</li>
            </ol>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Transaksi</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route($prefix.'.transaction.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Nama Pasien</label>
                                <input type="text" class="form-control" placeholder="Nama Pasien" name="nama" required>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select class="form-control" name="jk">
                                    <option selected>------Pilih Jenis Kelamin------</option>
                                    <option value="Laki - laki">Laki - laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Obat</label>
                                <input type="number" class="form-control" placeholder="Jumlah Obat" name="jumlah"
                                    required>
                            </div>

                            <div class="form-group">
                                <label>Nama Obat</label>
                                <input type="text" id="namaobat" class="form-control" placeholder="Nama Obat" disabled>
                                <input type="hidden" id="idobat" class="form-control" placeholder="Nama Obat"
                                    name="medicines_id" required>
                            </div>

                            <div class=" form-group row">

                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <input type="text" id="cari_obat" oninput="cariObat(this.value)"
                                                class="form-control" placeholder="Cari Nama Obat">

                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered" id="table_obat">
                                                        <thead>
                                                            <tr>
                                                                <th>Kode Obat</th>
                                                                <th>Nama Obat</th>
                                                                <th>Kategori</th>
                                                                <th>Harga</th>
                                                                <th>Stok</th>
                                                                <th>Pilih</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="data_obat">


                                                        </tbody>
                                                    </table>

                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script>
    function cariObat(nama) {

        if(!nama){
            $('#data_obat').html("");
        }else{
            $.ajax({
            url: "{{ route('cari.obat') }}",
            type: "GET",
            data: {
                nama: nama
            },
            success: function(data) {
                console.log(data);
                $('#data_obat').html("");

                data.forEach(function(item) {
                    $('#data_obat').append(
                        '<tr>' +
                        '<td>' + item.kode + '</td>' +
                        '<td>' + item.nama + '</td>' +
                        '<td>' + item.category.name + '</td>' +
                        '<td>' + item.harga + '</td>' +
                        '<td>' + item.stok + item.satuan + '</td>' +
                        '<td><span onclick="selectObat(' + item.id + ',' +"'"+ item.nama + "'"+ ')" class="btn btn-primary">Pilih</span></td>' +
                        '</tr>'
                    );
                });
            }
        });
        }

    }

    function selectObat(id,nama) {
        $('#namaobat').val(nama);
        $('#idobat').val(id);
        $('#cari_obat').val("");
        $('#data_obat').html("");
    }

</script>

@endsection
