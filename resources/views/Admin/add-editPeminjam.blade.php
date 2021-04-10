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
            <form action="@if(Request::segment(2) == null){{url('CreatePeminjam')}}@else{{url('UpdatePeminjam/'.$peminjam->id_peminjam)}}@endif" method="post">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Nis Peminjam</label>
                    <select class="form-control js-example-basic-single" name="nis">
                        @foreach($murid as $row)
                            <option disabled selected>- Pilih Murid -</option>
                            @if(Request::segment(2) != null)
                                <option <?php if($row->nis == $peminjam->NIS){ echo "selected"; } ?> value="{{$row->nis}}">{{$row->nis.' - '.$row->nama_murid}}</option>
                            @else
                                <option value="{{$row->nis}}">{{$row->nis.' - '.$row->nama_murid}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Tanggal Pinjam</label>
                            <input value="@if(Request::segment(2) != null){{$peminjam->tanggal_pinjam}}@endif" class="form-control" name="tgl_pinjam" type="date" placeholder="Default input">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Tanggal Kembali</label>
                            <input value="@if(Request::segment(2) != null){{$peminjam->tanggal_kembali}}@endif" class="form-control" name="tgl_kembali" type="date" placeholder="Default input">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Buku Yang di pinjam</label>
                            <select class="form-control js-example-basic-single" name="buku">
                                @foreach($buku as $row)
                                    <option disabled selected>- Pilih Buku -</option>
                                    @if(Request::segment(2) != null)
                                        <option <?php if($row->id_buku == $peminjam->id_buku){echo"selected";} ?> value="{{$row->id_buku}}">{{$row->nama_buku}}</option>
                                    @else
                                        <option value="{{$row->id_buku}}">{{$row->nama_buku}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-icon-split">
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