@extends('backend.index')
@section('sub-judul', 'Tabel Slider')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                </div>

                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="10%">No</th>
                                <th>No Transaksi</th>
                                <th>User</th>
                                <th>Subtotal</th>
                                <th>Status</th>
                                <th>Bank</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $data as $trans )
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $trans->no_transaksi }}</td>
                                <td>{{ $trans->user->name }}</td>
                                <td>{{ $trans->subtotal }}</td>
                                <td>{{ $trans->status }}</td>
                                <td>{{ $trans->type_bank }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
