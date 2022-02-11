@extends('layouts.admin')

@section('content')
<!-- row -->
<div class="container-fluid">
    <div class="form-head d-flex mb-3 mb-md-5 align-items-start">
        <div class="mr-auto d-none d-lg-block">
            <h3 class="text-primary font-w600">Dashboard User</h3>
        </div>

    </div>
    <div class="row">

        <div class="col-xl-6 col-xxl-12">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-sm-6">
                    <div class="widget-stat card bg-danger">
                        <div class="card-body  p-4">
                            <div class="media">
                                <span class="mr-3">
                                    <i class="flaticon-381-plus"></i>
                                </span>
                                <div class="media-body text-white text-right">
                                    <p class="mb-1">Jumlah Stok Obat</p>
                                    <h3 class="text-white">{{ $obat }} Obat</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-sm-6">
                    <div class="widget-stat card bg-success">
                        <div class="card-body p-4">
                            <div class="media">
                                <span class="mr-3">
                                    <i class="flaticon-381-percentage"></i>
                                </span>
                                <div class="media-body text-white text-right">
                                    <p class="mb-1">Jumlah Transaksi</p>
                                    <h3 class="text-white">{{ $trans }} Transaksi</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <h4 class="card-title">Transaksi Terakhir</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive ">
                                <table class="table patient-activity">
                                    @foreach ($transaksi as $item)
                                    <tr>
                                        <td>
                                            <div class="media align-items-center">
                                                <img class="mr-3 img-fluid rounded" width="78"
                                                    src="{{ asset('admin/images/avatar/1.png') }}" alt="DexignZone">
                                                <div class="media-body">
                                                    <h5 class="mt-0 mb-1">{{ $item->kode }}</h5>
                                                    <p class="mb-0">{{ $item->nama }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h5 class="my-0 text-primary">{{ $item->medicine->nama }}</h5>
                                            <p class="mb-0">{{ $item->jumlah }} {{ $item->medicine->satuan }}</p>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <h5 class="mt-0 mb-1 text-success">
                                                        {{ rupiah($item->total) }}
                                                    </h5>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>
                        <div class="card-footer border-0 pt-0 text-center">
                            <a href="#" class="btn-link">Selengkapnya >></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>
</div>
</div>
@endsection
