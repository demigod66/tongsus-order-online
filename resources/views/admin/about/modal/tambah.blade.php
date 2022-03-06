<div class="modal fade" id="modal-form" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form">
                <form id="form" action="#" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" value="" name="id" id="id">

                    <div class="form-group row">
                        <label class="control-label col-md-12 col-sm-12 ">Deskripsi</label>
                        <div class="col-md-12 col-sm-12">
                            <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"></textarea>
                            <span class="text-danger" id="nDeskripsiError"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-12 col-sm-12 ">Foto</label>
                        <div class="col-md-12 col-sm-12">
                            <input type="file" name="file" id="file" class="form-control" accept=".jpg,.png,.jpeg">
                            <span class="text-danger" id="nFotoError"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="simpan()">Simpan</button>
            </div>
        </div>
    </div>
</div>
