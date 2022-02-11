@extends('layouts.admin')

@section('content')
<!-- row -->

<div class="container-fluid">

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h3>Data User</h3>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin-page.index') }}">Beranda</a></li>
                <li class="breadcrumb-item active">User</li>
            </ol>
        </div>
    </div>

    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target=".tambah">
                        Tambah User
                    </button>
                    @include('pages.admin.user.add')
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>NIP</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->nip }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        @if ($item->roles == 1)
                                        <span class="badge light badge-success">User</span>
                                        @elseif ($item->roles == 2)
                                        <span class="badge light badge-primary">Admin</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <button type="button" class="btn btn-primary shadow btn-xs sharp mr-1"
                                                data-toggle="modal" data-target=".edit{{ $item->id }}">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                            @include('pages.admin.user.edit')
                                            <form method="POST"
                                                action="{{ route('admin-page.user.destroy', $item->id) }}">
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
                                    <td colspan="6" class="text-center">Data tidak ada</td>
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
