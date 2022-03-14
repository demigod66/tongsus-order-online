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
                        <label class="control-label col-md-12 col-sm-12 ">Nama Produk</label>
                        <div class="col-md-12 col-sm-12">
                            <input type="text" name="nama_produk" id="nama_produk" class="form-control">
                            <span class="text-danger" id="nProdukError"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-12 col-sm-12 ">Nama Kategori</label>
                        <div class="col-md-12 col-sm-12">
                            <select name="kategori_id" id="kategori_id" class="form-control">
                                @foreach ($kategori as $kat)
                                    <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger" id="nKategoriError"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-12 col-sm-12 ">Qty Produk</label>
                        <div class="col-md-12 col-sm-12">
                            <input type="text" class="form-control" id="qty" name="qty">
                            <span class="text-danger" id="nQtyError"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-12 col-sm-12 ">Harga Produk</label>
                        <div class="col-md-12 col-sm-12">
                            <input type="text" name="harga" id="harga" class="form-control">
                            <span class="text-danger" id="nHargaError"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-12 col-sm-12 ">Foto Produk</label>
                        <div class="col-md-12 col-sm-12">
                            <input type="file" name="foto_produk" id="foto_produk" class="form-control"
                                accept=".jpg,.png,.jpeg">
                            <span class="text-danger" id="nFotoError"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-12 col-sm-12 ">Keterangan</label>
                        <div class="col-md-12 col-sm-12">
                            <textarea name="keterangan" id="keterangan" class="form-control" cols="30"
                                rows="10"></textarea>
                            <span class="text-danger" id="nKetError"></span>
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
