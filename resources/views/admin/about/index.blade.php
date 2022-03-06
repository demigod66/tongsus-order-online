@extends('backend.index')
@section('sub-judul', 'Tabel About')
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
                                <th>Deskripsi</th>
                                <th>Foto</th>
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

    @include('admin.about.modal.tambah')
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('deskripsi');
        CKEDITOR.config.autoParagraph = false;
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            let typeSave;
            table = $('#example2').DataTable({
                processing: true,
                serverside: true,
                ajax: "{{ url('admin/about') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'deskripsi',
                        name: 'deskripsi'
                    },
                    {
                        data: 'foto_deskripsi',
                        name: 'foto_deskripsi',
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
            $('.modal-title').text('Tambah Data About');
        }

        function get(id) {
            typeSave = 'update';
            for (var instanceName in CKEDITOR.instances)
                CKEDITOR.instances[instanceName].updateElement();
            $.ajax({
                url: "{{ url('admin/about/edit') }}" + "/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('[name="id"]').val(data.id);
                    $('[name="deskripsi"]').val(data.deskripsi);
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
                url = "{{ url('admin/about/store') }}";
            } else {
                url = "{{ url('admin/about/update') }}" + "/" + id;
            }
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
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
                    $('#nDeskripsiError').text(response.responseJSON.errors.deskripsi);
                    $('#nFotoError').text(response.responseJSON.errors.foto_deskripsi);
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
                    url: "{{ url('admin/about/destroy') }}" + "/" + id,
                    type: "GET",
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
