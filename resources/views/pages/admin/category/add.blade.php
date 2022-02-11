<div class="modal fade bd-example-modal-lg tambah" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="basic-form">
                    <form action="{{ route($prefix.'.category.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Nama Kategori*</label>
                            <input type="text" class="form-control" name="name" placeholder="Contoh : Tablet">
                        </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Kategori</button>
                </form>
            </div>
        </div>
    </div>
</div>
