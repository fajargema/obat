<div class="modal fade bd-example-modal-lg edit{{ $item->id }}" id="" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Kategori</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="basic-form">
                    <form action="{{ route($prefix.'.category.update', $item->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label>Nama Kategori*</label>
                            <input type="text" class="form-control" name="name"
                                value="{{ old('name') ?? $item->name }}">
                        </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Ubah Kategori</button>
                </form>
            </div>
        </div>
    </div>
</div>
