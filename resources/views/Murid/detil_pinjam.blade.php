<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Detil Pinjaman</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
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
                        <li class="nav-item"><a class="nav-link" href="{{ url('/HomeMurid') }}">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/DetilPinjam') }}">Pinjaman</a></li>
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
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Detail Peminjaman</h1>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    @for($i=0; $i < count($data_buku); $i++)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="{{ url('/gambar_buku/'.$data_buku[$i]->gambar) }}" alt="..." width="100" height="300" />
                            <!-- Product details-->
                            <div class="card-body p-3">
                                <div class="text-center">
                                    <h5 class="fw-bolder">{{ $data_buku[$i]->nama_buku }}</h5>
                                    <p class="card-text">{{ $data_buku[$i]->deskripsi }}</p>
                                </div>
                                <div class="text-left">
                                    <table class="table table-striped mt-2">
                                        <tr>
                                            <td>Tanggal Pinjam</td>
                                            <td class="p-2">:</td>
                                            <td>{{ $peminjam[$i]->tanggal_pinjam }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Kembali</td>
                                            <td class="p-2">:</td>
                                            <td>{{ $peminjam[$i]->tanggal_kembali }}</td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td class="p-2">:</td>
                                            <td><span class="badge badge-info badge-sm">{{ $peminjam[$i]->status }}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Jatuh Tempo</td>
                                            <td class="p-2">:</td>
                                            <td>{{ $tenggang_waktu[$i] }} Hari</td>
                                        </tr>
                                        <tr>
                                            <td>Denda</td>
                                            <td class="p-2">:</td>
                                            <td>Rp. {{ $tenggang_waktu[$i] <= 0 ? '5000' : '0' }}</td>
                                        </tr>
                                    </table>
                                    <small class="mt-2 text-danger">nb : pengembalian terlambat denda Rp.5000 / Hari</small>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    @if ($peminjam[$i]->status != 'dikembalikan')
                                        <a class="btn btn-outline-dark mt-auto" href="{{ $peminjam[$i]->status == 'pending' ? url('UpdateStatus/'.$peminjam[$i]->id_peminjam) : url('UpdateStatus/'.$peminjam[$i]->id_peminjam.'/'.'kembali') }}">
                                            {{ $peminjam[$i]->status == 'pending' ? 'Terima' : 'Kembalikan' }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ url('') }}/assetsMurid/js/scripts.js"></script>
    </body>
</html>
