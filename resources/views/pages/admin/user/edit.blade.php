<div class="modal fade bd-example-modal-lg edit{{ $item->id }}" id="" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="basic-form">
                    <form action="{{ route('admin-page.user.update', $item->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label>Nama Pegawai</label>
                            <input type="text" class="form-control" placeholder="Masukan Nama Pegawai" name="name"
                                value="{{ old('name') ?? $item->name }}">
                        </div>
                        <div class="form-group">
                            <label>NIP</label>
                            <input type="number" class="form-control" placeholder="Masukan NIP" name="nip"
                                value="{{ old('nip') ?? $item->nip }}">
                        </div>
                        <div class="form-group">
                            <label>E-Mail</label>
                            <input type="email" class="form-control" placeholder="Masukan E-Mail" name="email"
                                value="{{ old('email') ?? $item->email }}">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select id="inputState" class="form-control" name="roles">
                                <option disabled>------Pilih Status------</option>
                                <option disabled>
                                    @if ($item->roles == 1)
                                    User (Status sekarang)
                                    @elseif ($item->roles == 2)
                                    Admin (Status sekarang)
                                    @endif
                                </option>
                                <option value="1">User</option>
                                <option value="2">Admin</option>
                            </select>
                        </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Ubah Pegawai</button>
                </form>
            </div>
        </div>
    </div>
</div>
