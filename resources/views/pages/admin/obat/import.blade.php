<div class="modal fade bd-example-modal-lg tambah" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Excel</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="basic-form">
                    <form method="POST" action="{{ route($prefix.'.medicine.import-obat')  }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>File Excel :</label>
                            <input type="file" name="file" class="form-control" required>
                        </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Upload Excel</button>
                </form>
            </div>
        </div>
    </div>
</div>
