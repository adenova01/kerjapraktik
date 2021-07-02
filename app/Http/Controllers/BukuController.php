<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buku = DB::table('buku')
            ->join('kategori','buku.kode_kategori','=','kategori.kode_kategori')
            ->get();
        return view('admin.page.databuku',compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('admin.page.add-editBuku', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $file = $request->file('gambar');
        $nama = str_replace(' ', '', $file->getClientOriginalName());
        $size = $file->getSize();
        $location = 'gambar_buku';
        
        $upload = $file->move($location, $nama);

        if($upload){
            
            $data = [
                'nama_buku' => $request->post('nama_buku'),
                'deskripsi' => $request->post('deskripsi'),
                'kode_kategori' => $request->post('kode_kategori'),
                'gambar'    => $nama,
                'create_by' => session('id')
            ];

            $insert = Buku::insert($data);

            if($insert){
                return redirect('AddBuku')->with('message', 'Buku Sukses di Tambahkan');
            } else {
                return redirect('AddBuku')->with('message', 'Buku Gagal di Tambahkan');
            }
        } else {
            return redirect('AddBuku')->with('message', 'Gambar Gagal di Upload Silahkan Coba Lagi');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori = Kategori::all();
        $buku = Buku::where('id_buku', $id)->first();
        return view('admin.page.add-editBuku', compact('buku','kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $file = $request->file('gambar');
        $nama = str_replace(' ', '', $file->getClientOriginalName());
        $size = $file->getSize();
        $location = 'gambar_buku';
        
        $upload = $file->move($location, $nama);

        if($upload){
            $data = [
                'nama_buku' => $request->post('nama_buku'),
                'deskripsi' => $request->post('deskripsi'),
                'gambar'    => $nama
            ];

            $update = Buku::where('id_buku', $id)->update($data);

            if($update){
                return redirect('AddBuku')->with('message', 'Buku Sukses di Ubah');
            } else {
                return redirect('AddBuku')->with('message', 'Buku Gagal di Ubah');
            }
        } else {
            return redirect('AddBuku')->with('message', 'Gambar Gagal di Upload Silahkan Coba Lagi');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nama_book = Buku::where('id_buku',$id)->first();
        $delete = Buku::where('id_buku', $id)->delete();
        return redirect('DataBuku')->with('message','Data Buku '.$nama_book->nama_buku.' Sukses Di hapus');
    }
}
