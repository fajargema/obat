<div class="modal fade bd-example-modal-lg tambah" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="basic-form">
                    <form action="{{ route('admin-page.user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Nama Pegawai</label>
                            <input type="text" class="form-control" placeholder="Masukan Nama Pegawai" name="name"
                                value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label>NIP</label>
                            <input type="text" class="form-control" placeholder="Masukan NIP" name="nip"
                                value="{{ old('nip') }}">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Masukan Email" name="email"
                                value="{{ old('email') }}">
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="roles">
                                <option selected>------Pilih Status------</option>
                                <option value="1">User</option>
                                <option value="2">Admin</option>
                            </select>
                        </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
