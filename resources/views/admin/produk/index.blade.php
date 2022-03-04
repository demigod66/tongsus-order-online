@extends('backend.index')
@section('sub-judul', 'Table Produk')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-right">
                        <button class="btn btn-primary btn-sm" onclick="tambah()"><i class="fas fa-plus"></i></button>
                    </div>
                </div>

                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="10%">No</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Kuantitas</th>
                                <th>Foto Produk</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

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
                            <label class="control-label col-md-12 col-sm-12 ">Kuantitas</label>
                            <div class="col-md-12 col-sm-12">
                                <input type="text" name="qty" id="qty" class="form-control">
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
                                <input type="file" name="file" id="file" class="form-control" accept=".jpg,.png,.jpeg">
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


    <script type="text/javascript">
        $(document).ready(function() {
            var typeSave;
            table = $('#example2').DataTable({
                processing: true,
                serverside: true,
                ajax: "{{ url('admin/produk') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama_produk',
                        name: 'nama_produk'
                    },
                    {
                        data: 'nama_kategori',
                        name: 'nama_kategori'
                    },
                    {
                        data: 'harga',
                        name: 'harga',
                        render: $.fn.dataTable.render.number(',', '.', 2, 'Rp.')
                    },
                    {
                        data: 'qty',
                        name: 'qty'
                    },
                    {
                        data: 'foto',
                        name: 'foto',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                order: [
                    [0, 'asc']
                ]
            });
        })


        function tambah() {
            typeSave = 'tambah';
            $('#id').val('');
            $('#form').trigger("reset");
            $('#modal-form').modal('show');
            $('.modal-title').text('Tambah Kategori');
        }

        function get(id) {
            typeSave = 'update';
            $.ajax({
                url: "{{ url('admin/produk/edit') }}" + "/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('[name="id"]').val(data.id);
                    $('[name="nama_produk"]').val(data.nama_produk);
                    $('[name="nama_kategori"]').val(data.nama_kategori);
                    $('[name="qty"]').val(data.qty);
                    $('[name="harga"]').val(data.harga);
                    $('[name="keterangan"]').val(data.keterangan);
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Edit Data Kategori');
                },

                error: function(jqXHR, textStatus, errorThrown) {
                    swal({
                        title: 'Terjadi kesalahan',
                        type: 'error',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                    });
                }

            });
        }


        function reload() {
            table.ajax.reload(null, false);
        }

        function simpan() {
            var url;
            var selectedId = $('#id').val();
            if (typeSave == 'tambah') {
                url = "{{ url('admin/produk/store') }}";
            } else {
                url = "{{ url('admin/produk/update') }}" + "/" + selectedId;
            }
            $.ajax({
                url: url,
                data: new FormData($('#form')[0]),
                data: {
                    "id": selectedId
                },
                type: "POST",
                dataType: 'JSON',
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status == true) {
                        $('#form').trigger("reset");
                        $('#modal-form').modal('hide');
                        swal({
                            title: 'Berhasil',
                            type: 'success',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false,
                        }).then(function() {
                            reload();
                        });
                    }

                },
                error: function(response) {
                    $('#nProdukError').text(response.responseJSON.errors.nama_produk);
                    $('#nKategoriError').text(response.responseJSON.errors.nama_kategori);
                    $('#nQtyError').text(response.responseJSON.errors.qty);
                    $('#nHargaError').text(response.responseJSON.errors.harga);
                    $('#nKeteranganError').text(response.responseJSON.errors.keterangan);
                }
            });
        }


        function hapus(id) {
            swal({
                title: 'Apakah kamu yakin?',
                type: 'warning',
                showCancelButton: true,
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                buttons: true
            }).then(function() {
                $.ajax({
                    url: "{{ url('admin/produk/destroy') }}" + "/" + id,
                    type: "delete",
                    dataType: "JSON",
                    success: function() {
                        swal({
                            title: 'Berhasil',
                            type: 'success',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false,
                        }).then(function() {
                            reload();
                        })
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        swal({
                            title: 'Terjadi kesalahan',
                            type: 'error',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false,
                        });
                    }
                });
            }, function(dismiss) {
                if (dismiss === 'cancel') {
                    swal({
                        title: 'Batal',
                        type: 'error',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                    })
                }
            });
        }
    </script>

@endsection
