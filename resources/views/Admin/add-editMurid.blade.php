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
            <form action="{{ Request::segment(2) == null ? url($action) : url($action) }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nama Murid</label>
                    <input name="nama_murid" type="text" class="form-control" id="exampleFormControlInput1" placeholder="example" value="{{ Request::segment(2) != null ? $murid->nama_murid : '' }}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">jenis Kelamin</label>
                    <div class="form-check">
                        <input <?= Request::segment(2) != null ? ( $murid->jenis_kelamin == 'L' ? 'checked' : '') : '' ?> class="form-check-input" type="radio" name="jenkel" value="L" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Laki - Laki
                        </label>
                    </div>
                    <div class="form-check">
                        <input <?= Request::segment(2) != null ? ( $murid->jenis_kelamin == 'P' ? 'checked' : '') : '' ?> class="form-check-input" type="radio" name="jenkel" value="P" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Perempuan
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">alamat</label>
                    <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ Request::segment(2) != null ? $murid->alamat : '' }}</textarea>
                </div>
                <button type="submit" class="btn btn-{{Request::segment(2) != null ? 'warning' : 'success'}} btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-{{Request::segment(2) != null ? 'edit' : 'check' }}"></i>
                    </span>
                    <span class="text">{{ Request::segment(2) != null ? 'Update' : 'Simpan' }}</span>
                </button>
            </form>
        </div>
    </div>
</div>

@stop