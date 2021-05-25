<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Murid Perpus</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ url('') }}/assetsMurid/assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ url('') }}/assetsMurid/css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">Perpustakaan</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/DetilPinjam') }}">Pinjaman <span class="badge badge-primary">{{$jumlah_pinjam}}</span></a></li>
                        <div class="dropdown ml-2">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{session('nama')}}
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ url('/Logout') }}">Logout</a>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page Content-->
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <h1 class="my-4">Buku Kategori</h1>
                    <div class="list-group">
                        <a class="list-group-item" href="#">Category 1</a>
                        <a class="list-group-item" href="#">Category 2</a>
                        <a class="list-group-item" href="#">Category 3</a>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="carousel slide my-4" id="carouselExampleIndicators" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li class="active" data-target="#carouselExampleIndicators" data-slide-to="0"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active"><img class="d-block" src="{{ url('') }}/assetsMurid/image/perpustakaan.jpg" alt="First slide" width="950" height="350" /></div>
                            <div class="carousel-item"><img class="d-block " src="{{ url('') }}/assetsMurid/image/perpus2.jpg" alt="Second slide" width="950" height="350" /></div>
                            <div class="carousel-item"><img class="d-block " src="{{ url('') }}/assetsMurid/image/perpus3.png" alt="Third slide" width="950" height="350" /></div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <div class="row">
                        @foreach($buku as $row)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100">
                                <a href="#"><img class="card-img-top" src="{{ url('gambar_buku/'.$row->gambar) }}" alt="..." width="700" height="300" /></a>
                                <div class="card-body">
                                    <h4 class="card-title"><a href="#">{{$row->nama_buku}}</a></h4>
                                    <p class="card-text">{{ $row->deskripsi }}</p>
                                    <div class="row">
                                        <div class="col-6">
                                            <button onClick="id_buku({{$row->id_buku}})" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Pinjam</button>
                                        </div>
                                        <div class="col-6">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Peminjaman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{url('CreatePeminjam')}}" method="post">
                        @csrf
                        <input type="hidden" id="id_buku" name="buku" value="" readonly="">
                        <input type="hidden" name="nis" value="{{session('nis')}}" readonly="">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Tanggal Pinjam</label>
                                    <input class="form-control" name="tgl_pinjam" type="date" placeholder="Default input">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Tanggal Kembali</label>
                                    <input class="form-control" name="tgl_kembali" type="date" placeholder="Default input">
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
        <!-- end modal -->
        <!-- Footer-->
        <footer class="py-3 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Perpustakaan 2021</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ url('') }}/assetsMurid/js/scripts.js"></script>
        <script>
            function id_buku(id)
            {
                $('#id_buku').val(id);
            }
    </script>
    </body>
</html>
