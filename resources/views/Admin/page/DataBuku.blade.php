@extends('admin.template.master')

@section('content')

@if(session('message'))
    <div class="alert alert-info">{{ session('message') }}</div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{Request::segment(1)}}</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id Buku</th>
                        <th>Gambar Buku</th>
                        <th>Nama Buku</th>
                        <th>kategori Buku</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Id Buku</th>
                        <th>Gambar Buku</th>
                        <th>Nama Buku</th>
                        <th>kategori Buku</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                @foreach($buku as $row)
                    <tr>
                        <td>{{$row->id_buku}}</td>
                        <td><img src="{{ url('gambar_buku/'.$row->gambar) }}" width="90" height="110" /></td>
                        <td>{{$row->nama_buku}}</td>
                        <td>{{$row->nama_kategori}}</td>
                        <td>{{$row->deskripsi}}</td>
                        <td>
                            <a href="{{ url('EditBuku/'.$row->id_buku) }}" class="btn btn-warning btn-circle"><i class="fa fa-edit"></i></a>
                            {{-- <a href="{{ url('DeleteBuku/'.$row->id_buku) }}" class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></a> --}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
