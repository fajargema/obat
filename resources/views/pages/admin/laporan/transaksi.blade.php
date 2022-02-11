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
                <h3>Laporan Transaksi</h3>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route($prefix.'.index') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Laporan Transaksi</li>
            </ol>
        </div>
    </div>

    <div class="row">

        <div class="col-12">
            <div class="card">

                <div class="card-header">

                    <div class="form-inline">

                        <form class="m-1" method="POST" action="{{ route($prefix.'.transaction.report-excel') }}">
                            <input type="hidden" name="from" value="{{ $from }}">
                            <input type="hidden" name="to" value="{{ $to }}">
                            <input type="hidden" name="format" value="excel">
                            @csrf
                            <button class="btn btn-success" type="submit">Download
                                Excel</button>
                        </form>

                        <form class="m-1" method="POST" action="{{ route($prefix.'.transaction.report-pdf') }}">
                            <input type="hidden" name="from" value="{{ $from }}">
                            <input type="hidden" name="to" value="{{ $to }}">
                            <input type="hidden" name="format" value="mpdf">
                            @csrf
                            <button class="btn btn-danger" type="submit">Download Pdf</button>
                        </form>

                        <form class="m-1" method="POST" action="{{ route($prefix.'.transaction.report-print-pdf') }}">
                            <input type="hidden" name="from" value="{{ $from }}">
                            <input type="hidden" name="to" value="{{ $to }}">
                            <input type="hidden" name="format" value="mpdf">
                            @csrf
                            <button class="btn btn-info" type="submit">Print</button>
                        </form>

                    </div>
                </div>

                <div class="card-body">
                    <label>Periode : {{ Carbon\Carbon::parse($from)->format('d M Y') }} - {{
                        Carbon\Carbon::parse($to)->format('d M Y') }}</label> <br>
                    <label>Di report oleh : {{ Auth::user()->name }}</label>

                    <br>
                    <div class="table table-bordered table-responsive">
                        <table class="display" style="min-width: 897px">
                            <thead>
                                <tr>
                                    <th>Invoice</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Obat</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transaction as $item)
                                <tr>
                                    <td>{{ $item->kode }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->jk }}</td>
                                    <td>{{ $item->medicine->nama }}</td>
                                    <td>{{ $item->jumlah }} {{ $item->medicine->satuan }}</td>
                                    <td class="text-success">{{ rupiah($item->total) }}</td>
                                </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr style="background-color: #eee;">
                                    <td>Omset Penjualan : </td>
                                    <td class="text-success" colspan="5">{{ rupiah($total) }}</td>
                                </tr>
                            </tfoot>


                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- Delete --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

@endsection
