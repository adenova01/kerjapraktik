@extends('admin.template.master')

@section('content')

<div class="col-lg-12">
    <!-- Default Card Example -->

    @if(session('message'))
    <div class="alert alert-info">{{session('message')}}</div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            {{Request::segment(1)}}
        </div>
        <div class="card-body">
            <form action="@if(Request::segment(2) == null){{url('CreateBuku')}}@else{{url('UpdateBuku/'.$buku->id_buku)}}@endif" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nama Buku / Judul</label>
                    <input name="nama_buku" type="text" class="form-control" id="exampleFormControlInput1" placeholder="example" value="@if(Request::segment(2) != null){{$buku->nama_buku}}@endif">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" id="exampleFormControlTextarea1" rows="3">@if(Request::segment(2) != null){{$buku->deskripsi}}@endif</textarea>
                </div>
                <div class="custom-file">
                    <input type="file" name="gambar" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Pilih foto</label>
                </div>
                <button type="submit" class="btn btn-success btn-icon-split mt-3">
                    <span class="icon text-white-50">
                        <i class="fas fa-check"></i>
                    </span>
                    <span class="text">Simpan</span>
                </button>
            </form>
        </div>
    </div>
</div>

@stop