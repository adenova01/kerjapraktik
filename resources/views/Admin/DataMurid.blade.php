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
                        <th>NIS</th>
                        <th>Nama Murid</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Password</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($murid as $row)
                    <tr>
                        <td>{{$row->nis}}</td>
                        <td>{{$row->nama_murid}}</td>
                        <td>{{$row->jenis_kelamin == 'L' ? 'laki-laki' : 'perempuan'}}</td>
                        <td>{{$row->alamat}}</td>
                        <td>{{$row->password}}</td>
                        <td>
                            <a href="{{ url('EditMurid/'.$row->nis) }}" class="btn btn-warning btn-circle"><i class="fa fa-edit"></i></a>
                            <a href="{{ url('DeleteMurid/'.$row->nis) }}" class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
