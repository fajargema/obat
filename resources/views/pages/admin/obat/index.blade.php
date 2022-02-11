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
                <h3>Data Obat</h3>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route($prefix.'.index') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Obat</li>
            </ol>
        </div>
    </div>

    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route($prefix.'.medicine.create') }}" class="btn btn-primary mb-2">
                        Tambah Obat
                    </a>
                    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target=".tambah">
                        Import Obat
                    </button>
                    @include('pages.admin.obat.import')
                    <a href="{{ route($prefix.'.medicine.tambah') }}" class="btn btn-primary mb-2">
                        Tambah Stok
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode</th>
                                    <th>Kategori</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Status</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->kode }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td class="text-success">{{ rupiah($item->harga) }}</td>
                                    <td>{{ $item->stok }} {{ $item->satuan }}</td>
                                    <td>
                                        @if ($item->stok <= 5) <span class="badge light badge-warning">Stok
                                            Keritis</span>
                                            @else
                                            <span class="badge light badge-success">Stok Tersedia</span>
                                            @endif
                                    </td>

                                    <td>
                                        {{ Carbon\Carbon::parse($item['tgl_masuk'])->format('d M Y') }}
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route($prefix.'.medicine.show', $item->id) }}"
                                                class="btn btn-info shadow btn-xs sharp mr-1" data-toggle="tooltip"
                                                title='Detail'>
                                                <i class="fas fa-book-reader"></i>
                                            </a>
                                            <a href="{{ route($prefix.'.medicine.edit', $item->id) }}"
                                                class="btn btn-primary shadow btn-xs sharp mr-1" data-toggle="tooltip"
                                                title='Edit'>
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <form method="POST"
                                                action="{{ route($prefix.'.medicine.destroy', $item->id) }}">
                                                @csrf
                                                @method('delete')
                                                <button type="submit"
                                                    class="btn btn-danger shadow btn-xs sharp show_confirm"
                                                    data-toggle="tooltip" title='Delete'>
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center">Data tidak ada</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- Delete --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
    var $ = jQuery;
    $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Are you sure you want to delete this record?`,
              text: "If you delete this, it will be gone forever.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });

</script>

@endsection
