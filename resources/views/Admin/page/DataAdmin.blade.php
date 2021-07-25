@extends('admin.template.master')

@section('content')
<!-- Page Heading -->
@if(session('message'))
    <div class="alert alert-info">{{ session('message') }}</div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{Request::segment(1)}}</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama Admin</th>
                        <th>Alamat</th>
                        <th>Username</th>
                        {{-- <th>Aksi</th> --}}
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nama Admin</th>
                        <th>Alamat</th>
                        <th>Username</th>
                        {{-- <th>Aksi</th> --}}
                    </tr>
                </tfoot>
                <tbody>
                @foreach($admin as $row)
                    <tr>
                        <td>{{$row->nama_admin}}</td>
                        <td>{{$row->alamat}}</td>
                        <td>{{$row->username}}</td>
                        {{-- <td> --}}
                            {{-- <a href="#" class="btn btn-warning btn-circle"><i class="fa fa-edit"></i></a> --}}
                            {{-- <a href="{{ url('DeletePeminjam/'.$row->id_peminjam) }}" class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></a> --}}
                        {{-- </td> --}}
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
