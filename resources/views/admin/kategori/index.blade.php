@extends('backend.index')
@section('sub-judul', 'Tabel Kategori')
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
                                <th>Nama Kategori</th>
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

    @include('admin.kategori.modal.tambah')


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            let typeSave;
            table = $('#example2').DataTable({
                processing: true,
                serverside: true,
                ajax: "{{ url('admin/kategori') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama_kategori',
                        name: 'nama_kategori'
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
                url: "{{ route('kategori.index') }}" + "/" + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('[name="id"]').val(data.id);
                    $('[name="nama_kategori"]').val(data.nama_kategori);
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
            var id = $('#id').val();
            if (typeSave == 'tambah') {
                url = "{{ route('kategori.store') }}";
            } else {
                url = "{{ url('admin/kategori/update') }}" + "/" + id;
            }
            $.ajax({
                url: url,
                data: new FormData($('#form')[0]),
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
                    $('#nKategoriError').text(response.responseJSON.errors.nama_kategori);
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
                    url: "{{ route('kategori.index') }}" + "/" + id,
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
